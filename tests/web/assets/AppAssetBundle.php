<?php
/**
 * AppAssetBundle.php
 */

namespace fbalabanov\yii\module\Comments\tests\web\assets;

/**
 * Class AppAssetBundle
 * @package fbalabanov\yii\module\Comments\tests\web\assets
 */
class AppAssetBundle extends \yii\web\AssetBundle
{

    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
    ];

    public $js = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}