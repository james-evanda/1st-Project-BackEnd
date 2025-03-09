<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=[
        'invoice_number',
        'customer_name',
        'total_price',
        'status',
    ];

    public function user(){

        return $this->belongsTo(User::class);
        
    }
}
