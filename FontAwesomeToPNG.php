<?php

/**
 * convert font awesome css icon to png
 * author: lly365 <lly365@gmail.com>
 */

namespace In\Baoyu;


class FontAwesomeToPNG {
    use FontAwesomeIcons;

    const FONT_AWESOME_VERSION = 4.7;
    const FONT_AWESOME_TO_PNG_VERSION = 0.1;


    function __construct() {
        if(!(class_exists('\Imagick') && class_exists('\ImagickDraw') && class_exists('\ImagickPixel'))){
            throw new \Exception('你需要安装Imagick扩展。You need install Imagick extension');
        }
    }

    function &to($icon_name, $size, $color, $font_file, $bgcolor = null){
        $str = $this->getIconCode($icon_name);

        $image = new \Imagick();
        $draw = new \ImagickDraw();
        $background = new \ImagickPixel($bgcolor ? $bgcolor : 'none');
        $color = new \ImagickPixel($color);

        $draw->setFont($font_file);
        $draw->setFontSize($size);
        $draw->setFillColor($color);
        //$draw->setStrokeAntialias(true);
        //$draw->setTextAntialias(true);

        $metrics = $image->queryFontMetrics($draw, $str);

        $draw->annotation(0, $metrics['ascender'], $str);

        $image->newImage($metrics['textWidth'], $metrics['textHeight'], $background);
        $image->setImageFormat('png');
        $image->drawImage($draw);

        return $image;
    }

    function showToPage(\Imagick $image){
        header('content-type:image/png');
        echo $image;
    }

    function saveToFile(\Imagick $image, $file_name){
        $image->writeImage($file_name);
    }

    private  function getIconCode($icon_name){
        $fa_icons = $this->fa_icons();
        if(empty($fa_icons[$icon_name])){
            throw new \Exception('不存在的图标. icon not exists.');
        }
        return $fa_icons[$icon_name];
    }
}