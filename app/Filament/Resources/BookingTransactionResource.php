<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->maxLength(255)
                ->required(),
                
                Forms\Components\TextInput::make('trx_id')
                ->maxLength(255)
                ->required(),
                
                Forms\Components\TextInput::make('phone_number')
                ->maxLength(20)
                ->required(),
                
                Forms\Components\TextInput::make('total_amount')
                ->prefix('IDR')
                ->numeric()
                ->required(),
                
                Forms\Components\DatePicker::make('started_at')
                ->required(),
                
                Forms\Components\TimePicker::make('time_at')
                ->required(),
                
                Forms\Components\Select::make('is_paid')
                ->options([
                    true => 'Paid',
                    false => 'Unpaid'
                ])
                ->required(),
                
                Forms\Components\Select::make('car_service_id')
                ->relationship('service_details', 'name')
                ->searchable()
                ->preload()
                ->required(),
                
                Forms\Components\Select::make('car_store_id')
                ->relationship('store_details', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\FileUpload::make('proof')
                ->image()
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('trx_id')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('total_amount'),
                Tables\Columns\TextColumn::make('started_at'),
                Tables\Columns\TextColumn::make('time_at'),
                Tables\Columns\IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Is Paid?'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
