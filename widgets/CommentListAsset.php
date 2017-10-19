<?php
/**
 * CommentListAsset.php
 */

namespace fbalabanov\yii\module\Comments\widgets;

/**
 * Class CommentListAsset
 * @package fbalabanov\yii\module\Comments\widgets
 */
class CommentListAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@vendor/fbalabanov/yii2-comments/widgets/_assets';

    public $css = [
        'comment-list.css',
    ];

    public $js = [
        'comment-list.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}
