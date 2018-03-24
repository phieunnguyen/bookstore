<?php
namespace App\lib\Facades;
use App\lib\ToolFactory;
use Illuminate\Support\Facades\Facade;
class Tool extends Facade{
  protected static function getFacadeAccessor(){
    return ToolFactory::class;
  }
}
?>
