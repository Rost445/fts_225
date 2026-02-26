<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  public function order()
  {
      return $this->belongsTo(Order::class);
  }
  public function getModeLabelAttribute(): string
{
    return match ($this->mode) {
        'card'   => 'Кредитна картка',
        'cod'    => 'Післяплата',
        'paypal' => 'PayPal',
        default  => '—',
    };
}
}
