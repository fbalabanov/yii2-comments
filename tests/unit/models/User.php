<?php
/**
 * User.php
 */

namespace fbalabanov\yii\module\Comments\tests\unit\models;

use fbalabanov\yii\module\Comments\interfaces\CommentatorInterface;

/**
 * Class User
 * @package fbalabanov\yii\module\Comments\tests\unit\models
 */
class User extends \yii\base\Model implements CommentatorInterface
{

    /**
     * @return string|false
     */
    public function getCommentatorAvatar()
    {
        return 'https://avatar';
    }

    /**
     * @return string
     */
    public function getCommentatorName()
    {
        return 'User name';
    }

    /**
     * @return string|false
     */
    public function getCommentatorUrl()
    {
        return 'https://user';
    }
}