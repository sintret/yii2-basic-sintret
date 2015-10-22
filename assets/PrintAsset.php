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
class PrintAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/print.css',
        //'adminlte/css/AdminLTE.css', // THIS CHANGE
       // 'adminlte/less/dropdown.less', // THIS CHANGE
        //'font-awesome-4.2.0/css/font-awesome.min.css', // THIS CHANGE
    ];
    public $js = [
        //'adminlte/js/AdminLTE/app.js',
        //'js/jquery.number.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
       // 'yii\bootstrap\BootstrapPluginAsset'
    ];

}
