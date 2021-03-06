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
class BowerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $sourcePath = '@bower';

    public $css = [
        'bootstrap-pincode-input/css/bootstrap-pincode-input.css'
    ];
    public $js = [
        'bootstrap-pincode-input/js/bootstrap-pincode-input.js'
    ];
}
