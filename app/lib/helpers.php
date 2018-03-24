<?php
use App\lib\Facades\Tool;
if (!function_exists('get_thumbnail')) {
  function get_thumbnail($fileName){
    return Tool::getThumbnail($fileName);
  }
}
?>
