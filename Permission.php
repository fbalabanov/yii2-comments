<?php
/**
 * Permission.php
 */

namespace fbalabanov\yii\module\Comments;

/**
 * Class Permission
 * @package fbalabanov\yii\module\Comments
 */
class Permission
{

    const CREATE = 'comments.create';
    const UPDATE = 'comments.update';
    const UPDATE_OWN = 'comments.update.own';
    const DELETE = 'comments.delete';
    const DELETE_OWN = 'comments.delete.own';
}
