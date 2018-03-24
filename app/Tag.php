<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag  extends Model
{
  protected $table = 'tags';
  protected $fillable = [
    'name',
    'slug',
  ];  

  /**
   * undocumented function
   *
   * @return void
   */
  public function products()
  {
    return $this->belongsToMany('App\Product', 'product_tag', 'tag_id', 'product_id');
  }
  
}
