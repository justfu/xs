<?php
namespace Tools;
class Logo{
    private $re;

    //初始化logo制作类
    public function __construct(){


    }

    public function getImage($name){
        $image = imagecreatetruecolor(128, 128);

        imageantialias($this->re,true);

// fill the background color
        $bg = imagecolorallocate($image, 255, 255, 255);

        imagefill($image,0,0,$bg);

// choose a color for the ellipse
        $col_ellipse = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));

// draw the white ellipse
        imagefilledellipse($image, 64, 64, 128, 128, $col_ellipse);

// output the picture
        header("Content-type: image/png");
        imagepng($image);


    }




}