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
class WebAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $sourcePath = '@bower/bootstrap-pincode-input';

    public $js = [
    	'filter/filter-cure-main.js',
        'js/angular.min.js',
        'js/main.js',
        'js/copyright.min.js'
    ];

    public $css = [
		'filter/filter-cure-main.css',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
	];
    public $depends = [
        'yii\web\JqueryAsset',
        'app\assets\BowerAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
