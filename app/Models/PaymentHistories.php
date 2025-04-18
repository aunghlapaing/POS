<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentHistories extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'phone', 
        'address', 
        'payslip_image',
        'payment_method',
        'order_code',
        'total_amt'
    ];
}
