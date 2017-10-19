<?php
/**
 * CommentQuery.php
 */

namespace fbalabanov\yii\module\Comments\models\queries;

use fbalabanov\yii\module\Comments;

/**
 * Class CommentQuery
 * @package fbalabanov\yii\module\Comments\models\queries
 *
 * @method \fbalabanov\yii\module\Comments\models\Comment|array|null one($db = null)
 * @method \fbalabanov\yii\module\Comments\models\Comment[]|array all($db = null)
 */
class CommentQuery extends \yii\db\ActiveQuery
{

    /**
     * @param integer|array $id
     * @return static
     */
    public function byId($id)
    {
        $this->andWhere(['id' => $id]);

        return $this;
    }

    /**
     * @param string|array $entity
     * @return static
     */
    public function byEntity($entity)
    {
        $this->andWhere(['entity' => $entity]);

        return $this;
    }

    /**
     * @return static
     */
    public function withoutDeleted()
    {
        /** @var Comments\models\Comment $CommentModel */
        $CommentModel = \Yii::createObject(Comments\Module::instance()->model('comment'));

        $this->andWhere(['deleted' => $CommentModel::NOT_DELETED]);

        return $this;
    }
}
