<?php
require_once 'phpqrcode/qrlib.php';
$QRcode = new \QRcode();
//二维码保存地址
$filename ="code.png";
//内容
$text = "http://phpqrcode.sourceforge.net/";
//校正级别 'L','M','Q','H' 默认L
$level = "L";
//大小 1-10 默认 3
$size = 5;
//边界空白大小，默认4
$margin = 0;
// 生成本地图片
$QRcode->png($text,$filename,$level,$size,$margin);

/**添加logo**/
//logo的图片地址
$logo = 'logo.jpg';
$QR = $filename;
if($logo){
    $QR = imagecreatefromstring(file_get_contents($filename));
    $logo = imagecreatefromstring(file_get_contents($logo));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);
    $logo_qr_width = $QR_width / 5;
    $scale = $logo_width / $logo_qr_width;
    $logo_qr_height = $logo_height / $scale;
    $from_width = ($QR_width - $logo_qr_width) / 2;
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    imagepng($QR, $filename);
}

if(file_exists($filename)){
    echo $filename;
}else{
    echo false;
}

