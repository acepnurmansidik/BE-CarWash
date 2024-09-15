<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CarStore;
use App\Models\CarService;
use Illuminate\Http\Request;
use App\Models\BookingTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreBookingPaymentRequest;
use Carbon\Carbon;

class FrontController extends Controller
{
    //
    public function index(){
        $cities = City::all();
        $services = CarService::withCount(['storeServices'])->get();
        return view("front.index", compact('cities', 'services'));
    }

    public function search(Request $request){
        $cityId = $request->input('city_id');
        $serviceTypeId = $request->input('service_type');

        $carService = CarService::where("id", $serviceTypeId)->first();
        if(!$carService){
            return redirect()->back()->with('error', "Service type not found.");
        }

        $stores = CarStore::whereHas('storeServices', function($query) use ($carService){
            $query->where('car_service_id', $carService->id);
        })->where('city_id', $cityId)->get();

        $city = City::find($cityId);

        // save service to session
        session()->put('serviceTypeId', $request->input('service_type'));
        return view("front.stores",[
            'stores' => $stores,
            'carService' => $carService,
            'cityName' => $city ? $city->name : "Unknown City",
        ]);
    }

    public function details(CarStore $carStore){
        // get service from session
        $serviceTypeId = session()->get('serviceTypeId');
        $carService = CarService::where("id", $serviceTypeId)->first();
        return view("front.details", ['carStore' => $carStore, 'carService' => $carService]);
    }

    public function booking(CarStore $carStore){
        session()->put('carStoreId', $carStore->id);
        // get data service from session
        $serviceTypeId = session()->get('serviceTypeId');
        $carService = CarService::where('id', $serviceTypeId)->first();
        return view("front.booking", [ 'carStore' => $carStore, 'carService' => $carService ]);
    }

    public function booking_store(StoreBookingRequest $request){
        $customerName = $request->input('name');
        $customerPhoneNumber = $request->input('phone_number');
        $customerTimeAt = $request->input('time_at');

        // simpan dulu ke dalam session, jika sewaktu-waktu customer melakukan perubahan
        session()->put('customerName', $customerName);
        session()->put('customerPhoneNumber', $customerPhoneNumber);
        session()->put('customerTimeAt', $customerTimeAt);

        $serviceTypeId = session()->get('serviceTypeId');
        $carStoreId = session()->get('carStoreId');

        return redirect()->route('front.booking.payment', [ $carStoreId, $serviceTypeId ]);
    }

    public function booking_payment(CarStore $carStore, CarService $carService){
        $ppn = 0.11;
        $totalPpn = $carService->price * $ppn;
        $bookingFee = 25000;
        $grandTotal = round($totalPpn + $bookingFee + $carService->price);

        session()->put('totalAmount', $grandTotal);
        return view('front.payment', [
            'carStore' => $carStore,
            'carService' => $carService,
            'totalPpn' => $totalPpn,
            'ppn' => $ppn,
            'bookingFee' => $bookingFee,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function booking_payment_store(StoreBookingPaymentRequest $request){
        $customerName = session()->get('customerName');
        $customerPhoneNumber = session()->get('customerPhoneNumber');
        $totalAmount = session()->get('totalAmount');
        $customerTimeAt = session()->get('customerTimeAt');
        $serviceTypeId = session()->get('serviceTypeId');
        $carStoreId = session()->get('carStoreId');

        $bookingTransactionId = null;

        // closured c=based database transaction
        DB::transaction(function() use ($request, $customerName, $customerPhoneNumber, $totalAmount, $customerTimeAt, $serviceTypeId, $carStoreId, &$bookingTransactionId){
            $validated = $request->validated();

            if($request->hasFile('proof')){
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['name'] = $customerName;
            $validated['phone_number'] = $customerPhoneNumber;
            $validated['total_amount'] = $totalAmount;
            $validated['started_at'] = Carbon::tomorrow()->format('Y-m-d');
            $validated['time_at'] = $customerTimeAt;
            $validated['car_service_id'] = $serviceTypeId;
            $validated['car_store_id'] = $carStoreId;
            $validated['is_paid'] = false;
            $validated['trx_id'] = BookingTransaction::generateUniqueTrxId();

            // simpan ke database
            $newBooking = BookingTransaction::create($validated);

            $bookingTransactionId = $newBooking->id;
        });

        return redirect()->route('front.success_booking', $bookingTransactionId);
    }

    public function success_booking(BookingTransaction $bookingTransaction){
        return view('front.success_booking', compact('bookingTransaction'));
    }
    
    public function transactions(){
        return view('front.transactions');
    }
    
    public function transaction_details(Request $request){
        $request->validate([
            'trx_id' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
        ]);

        $trx_id = $request->input('trx_id');
        $phone_number = $request->input('phone_number');

        $details = BookingTransaction::with(['service_details', 'store_details'])->where('trx_id', $trx_id)->where('phone_number', $phone_number)->first();

        if(!$details){
            return redirect()->back()->withErrors(['error' => 'Transactions not found.']);
        }
        $ppn = 0.11;
        $totalPpn = $details->service_details->price * $ppn;
        $bookingFee = 25000;

        return view('front.transaction_details', compact('details', 'totalPpn', 'bookingFee'));
    }
}
