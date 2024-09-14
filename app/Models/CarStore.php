<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarStore extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'is_open',
        'is_full',
        'city_id',
        'addresss',
        'phone_number',
        'cs_name',
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function photos():HasMany{
        return $this->hasMany(StorePhoto::class, 'car_store_id');
    }

    public function storeServices():HasMany{
        return $this->hasMany(StoreService::class, 'car_store_id');
    }

    public function city():BelongsTo{
        return $this->belongsTo(City::class, 'city_id');
    }
}
