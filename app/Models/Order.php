<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    public $fillable = [
        'user_id',
        'shipping_id',
        'payment_id',
        'order_no',
        'order_total',
        'status',
    ];
    
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
    
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }
    
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
