<?php
/**
 * CommentCreateForm.php
 */

namespace fbalabanov\yii\module\Comments\forms;

use fbalabanov\yii\module\Comments;

/**
 * Class CommentCreateForm
 * @package fbalabanov\yii\module\Comments\forms
 */
class CommentCreateForm extends \yii\base\Model
{

    public $id;
    public $entity;
    public $from;
    public $text;
    public $parent_id;

    /** @var Comments\models\Comment */
    public $Comment;

    public function init()
    {
        $Comment = $this->Comment;

        if (false === $this->Comment->isNewRecord) {
            $this->id = $Comment->id;
            $this->entity = $Comment->entity;
            $this->from = $Comment->from;
            $this->text = $Comment->text;
            $this->parent_id = $Comment->parent_id;
        } elseif (!\Yii::$app->getUser()->getIsGuest()) {
            $User = \Yii::$app->getUser()->getIdentity();

            $this->from = $User instanceof Comments\interfaces\CommentatorInterface
                ? $User->getCommentatorName()
                : null;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $CommentModelClassName = Comments\Module::instance()->model('comment');

        return [
            [['entity', 'text'], 'required'],
            [['entity', 'from', 'text'], 'string'],
            [['id', 'parent_id'], 'integer'],
            [['id'], 'exist', 'targetClass' => $CommentModelClassName, 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entity' => \Yii::t('app', 'Entity'),
            'from' => \Yii::t('app', 'Your name'),
            'text' => \Yii::t('app', 'Text'),
        ];
    }

    /**
     * @return bool
     * @throws \yii\web\NotFoundHttpException
     */
    public function save()
    {
        $Comment = $this->Comment;

        $CommentModelClassName = Comments\Module::instance()->model('comment');
        $isNew = false;
        if (empty($this->id)) {
            $isNew = true;
            $Comment = \Yii::createObject($CommentModelClassName);
        } elseif ($this->id > 0 && $Comment->id !== $this->id) {
            /** @var Comments\models\Comment $CommentModel */
            $CommentModel = \Yii::createObject($CommentModelClassName);
            $Comment = $CommentModel::find()
                ->byId($this->id)
                ->one();

            if (!($Comment instanceof Comments\models\Comment)) {
                throw new \yii\web\NotFoundHttpException;
            }
        }

        $Comment->entity = $this->entity;
        $Comment->from = $this->from;
        $Comment->text = $this->text;
        if (isset($this->parent_id)) {
            $Comment->parent_id = $this->parent_id;

            if ($isNew) {
                $ParentComment = $Comment->parent;
				if ($ParentComment) {
					$Comment->lineage = $ParentComment->lineage;
					$Comment->depth = $ParentComment->depth + 1;
				}
            }
        } else if ($isNew) {
            $Comment->depth = 0;
            $Comment->lineage = '';
        }

        $result = $Comment->save();

        if ($Comment->hasErrors()) {
            foreach ($Comment->getErrors() as $attribute => $messages) {
                foreach ($messages as $mes) {
                    $this->addError($attribute, $mes);
                }
            }
        } else {

            if ($isNew) {
                // We need the id to correctly set the lineage
                $Comment->refresh();
				if (empty($Comment->lineage)) {
					$Comment->lineage .= $Comment->id;
				} else {
					$Comment->lineage .= ('-' . $Comment->id);
				}

                $result = $Comment->save();

                if ($Comment->hasErrors()) {
                    foreach ($Comment->getErrors() as $attribute => $messages) {
                        foreach ($messages as $mes) {
                            $this->addError($attribute, $mes);
                        }
                    }
                }
            }
        }

        $this->Comment = $Comment;

        return $result;
    }
}
