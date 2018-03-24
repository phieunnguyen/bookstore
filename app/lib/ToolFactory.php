<?php
namespace App\lib;

/**
 * Class ToolFactory
 * @author yourname
 */
class ToolFactory
{
  /**
   * undocumented function
   *
   * @return void
   */
  public function getThumbnail($fileName)
  {
    if ($fileName) {
      return preg_replace("/(.*)\.(.*)/i", '$1_thumb.$2', $fileName);
    }
    return '';
  }
    
}
?>
