<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;

class Tools
{
    public static function getpreview64($path)
    {
        if(is_file($path))
        {
            $image        = $path;
            $image_resize = Image::make($image);              
            $image_resize->resize(64, 64, function ($constraint) {
                // $constraint->aspectRatio();
            });
            $url = $image_resize->encode('data-url');
            return $url;
        }
        return false;
    }    
    
    public static function getpreview32($path)
    {
        if(is_file($path))
        {
            $image        = $path;
            $image_resize = Image::make($image);              
            $image_resize->resize(32, 32, function ($constraint) {
                // $constraint->aspectRatio();
            });
            $url = $image_resize->encode('data-url');
            return $url;
        }
        return false;
    }
}
