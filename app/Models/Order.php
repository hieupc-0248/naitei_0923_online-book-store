<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getOrderStatusAttribute()
    {
        $orderStatusConfig = config('app.order_status');

        $statusText = array_search($this->status, $orderStatusConfig);

        return $statusText !== false ? $statusText : 'pending';
    }
}
