<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';
  protected $fillable = [
    'name',
    'code',
    'summary',
    'regular_price',
    'sale_price',
    'original_price',
    'quantity',
    'attributes',
    'image',
    'user_id',
    'category_id'
  ];  
  /**
   * undocumented function
   *
   * @return void
   */
  public function category()
  {
    return $this->belongsTo('App\Category', 'category_id','id' );
  }
  
  public function user()
  {
    return $this->belongsTo('App\User','user_id' ,'id');
  }
  /**
   * undocumented function
   *
   * @return void
   */
  
  public function tags()
  {
    return $this->belongsToMany('App\Tag', 'product_tag', 'product_id', 'tag_id')->withTimestamps();
  }
  public function orders()
  {
    return $this->belongsToMany('App\Product', 'product_order', 'product_id', 'order_id')->withPivot('quantity')->withTimestamps();
  }
  
}
