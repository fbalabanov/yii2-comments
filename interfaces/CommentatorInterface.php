<?php
/**
 * CommentatorInterface.php
 */

namespace fbalabanov\yii\module\Comments\interfaces;

/**
 * Interface CommentatorInterface
 * @package fbalabanov\yii\module\Comments\interfaces
 */
interface CommentatorInterface
{

    /**
     * @return string|false
     */
    public function getCommentatorAvatar();

    /**
     * @return string
     */
    public function getCommentatorName();

    /**
     * @return string|false
     */
    public function getCommentatorUrl();
}
