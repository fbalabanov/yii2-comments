<?php
/**
 * Comment.php
 */

namespace fbalabanov\yii\module\Comments\models;

use fbalabanov\yii\module\Comments;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * Class Comment
 * @package fbalabanov\yii\module\Comments\models
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $entity
 * @property string $from
 * @property string $text
 * @property integer $deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property integer depth
 * @property string lineage
 *
 * @property \yii\db\ActiveRecord $author
 * @property \yii\db\ActiveRecord $lastUpdateAuthor
 *
 * @method queries\CommentQuery hasMany(string $class, array $link) see BaseActiveRecord::hasMany() for more info
 * @method queries\CommentQuery hasOne(string $class, array $link) see BaseActiveRecord::hasOne() for more info
 */
class Comment extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'blameable' => BlameableBehavior::className(),
            'timestamp' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['from', 'text'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['deleted'], 'boolean'],
            [['deleted'], 'default', 'value' => self::NOT_DELETED],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
			'parent_id' => \Yii::t('app', 'Parent ID'),
            'entity' => \Yii::t('app', 'Entity'),
            'from' => \Yii::t('app', 'Comment author'),
            'text' => \Yii::t('app', 'Comment'),
            'created_by' => \Yii::t('app', 'Created by'),
            'updated_by' => \Yii::t('app', 'Updated by'),
            'created_at' => \Yii::t('app', 'Created at'),
            'updated_at' => \Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return bool
     */
    public function isEdited()
    {
        return $this->created_at !== $this->updated_at;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted === self::DELETED;
    }

    /**
     * @return bool
     */
    public static function canCreate()
    {
        return Comments\Module::instance()->useRbac === true
            ? \Yii::$app->getUser()->can(Comments\Permission::CREATE)
            : true;
    }

    /**
     * @return bool
     */
    public function canUpdate()
    {
        $User = \Yii::$app->getUser();

        return Comments\Module::instance()->useRbac === true
            ? (\Yii::$app->getUser()->can(Comments\Permission::UPDATE) || \Yii::$app->getUser()->can(Comments\Permission::UPDATE_OWN, ['Comment' => $this]))
            : ($User->isGuest ? false : ($this->created_by === $User->id));
    }

    /**
     * @return bool
     */
    public function canDelete()
    {
        $User = \Yii::$app->getUser();

        return Comments\Module::instance()->useRbac === true
            ? (\Yii::$app->getUser()->can(Comments\Permission::DELETE) || \Yii::$app->getUser()->can(Comments\Permission::DELETE_OWN, ['Comment' => $this]))
            : ($User->isGuest ? false : ($this->created_by === $User->id));
    }

    /**
     * @return queries\CommentQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Comments\Module::instance()->userIdentityClass, ['id' => 'created_by']);
    }

    /**
     * @return queries\CommentQuery
     */
    public function getLastUpdateAuthor()
    {
        return $this->hasOne(Comments\Module::instance()->userIdentityClass, ['id' => 'updated_by']);
    }

	/**
	 * @return queries\CommentQuery
	 */
	public function getParent()
	{
		return $this->hasOne(Comments\Module::instance()->model('comment'), ['id' => 'parent_id']);
	}

    /**
     * @return queries\CommentQuery
     */
    public static function find()
    {
        return \Yii::createObject(
            Comments\Module::instance()->model('commentQuery'),
            [get_called_class()]
        );
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    const NOT_DELETED = 0;
    const DELETED = 1;
}