<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'postal_code',
        'city_corporation',
        'upazila',
        'zillah',
        'district',
        'country',
        'data_of_birth',
        'gender',
        'notes',
    ];

    // Optional: Define casts for specific attributes
    protected $casts = [
        'data_of_birth' => 'datetime', // Cast to a Carbon instance
    ];
}
