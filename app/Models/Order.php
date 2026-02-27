<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function orderItems()
   {
       return $this->hasMany(OrderItem::class);
   }

   public function transaction()
   {
       return $this->hasOne(Transaction::class);
   }

   public function getStatusUaAttribute()
{
    return [
        'ordered'    => 'Замовлено',
        'processing' => 'В обробці',
        'shipped'    => 'Відправлено',
        'completed'  => 'Завершено',
        'canceled'   => 'Скасовано',
    ][$this->status] ?? $this->status;
}
}
