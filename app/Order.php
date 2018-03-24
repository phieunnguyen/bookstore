<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';
  protected $fillable = [
    'user_id',
    'address',
    'email',
    'phone'
  ];  

  /**
   * undocumented function
   *
   * @return void
   */
  public function products()
  {
    return $this->belongsToMany('App\Product', 'product_order', 'order_id', 'product_id')->withPivot('quantity')->withTimestamps();
  }
  
}
