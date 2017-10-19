<?php
/**
 * CommentFormAsset.php
 */

namespace fbalabanov\yii\module\Comments\widgets;

/**
 * Class CommentFormAsset
 * @package fbalabanov\yii\module\Comments\widgets
 */
class CommentFormAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@vendor/fbalabanov/yii2-comments/widgets/_assets';

    public $css = [
        'comment-form.css',
    ];
}
