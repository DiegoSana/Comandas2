<?php

namespace app\assets;

use yii\web\AssetBundle;

class LandingAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/landing/assets';
    public $css = [
        'css/bootstrap.css',
        'css/main.css',
        'css/font-awesome.min.css',
        'css/animate-custom.css',
        '//fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic',
        '//fonts.googleapis.com/css?family=Raleway:400,300,700',
    ];
    public $js = [
        //'js/modernizr.custom.js',
        'js/bootstrap.min.js',
        'js/retina.js',
        'js/jquery.easing.1.3.js',
        'js/smoothscroll.js',
        'js/jquery-func.js',
    ];
    public $depends = [];
}
