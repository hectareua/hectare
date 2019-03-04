<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InfoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $sourcePath = '@bower/bootstrap-pincode-input';
    public $css = [
        '/css/bootstrap.min.css',
        '/css/info.css',
        '/css/info-fix.css',
        '/css/rp-public.css',

    ];

    public $js = [
        '/js/jquery.cookie.js',
        '/js/jquery.advancedSlider.min.js',
        '/js/jquery.touchSwipe.min.js',
        '/js/jquery.jscrollpane.min.js',
        '/js/jquery.mousewheel.js',
        '/js/info.js',
        '/js/copyright.min.js',
        '/js/rp-public.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'app\assets\BowerAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
