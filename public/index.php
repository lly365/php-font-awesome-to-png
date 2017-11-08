<?php

define('BAOYU_ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR);

require_once BAOYU_ROOT_PATH . 'vendor/autoload.php';


//font awesome的字体文件路径
//path of font awesome's font file
$font_file = BAOYU_ROOT_PATH . 'FontAwesome.otf';

//图标名。font awesome 中的 class 名称去除fa-前缀
//icon name. font awesome's class name without fa- prefix
$icon_name = 'linux';

//尺寸
//size
$size = 512;

//图标的颜色
//icon's color
$color = '#e95420';

//背景颜色，如果为NULL，则为透明背景
//background color. if this value is NULL, transparent
$bgcolor = null;


try {
    //实例化一个转换对象
    //create a convert object
    $fa_to_png = new \In\Baoyu\FontAwesomeToPNG();

    //调用to方法进行转换
    //invoke to method to convert
    $image = $fa_to_png->to($icon_name, $size, $color, $font_file, $bgcolor);

    //将转换后的PNG显示在页面里
    //display converted PNG on web page
    $fa_to_png->showToPage($image);
} catch (Exception $e){
    echo $e->getMessage();
}
