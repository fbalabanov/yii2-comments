<?php
/**
 * comment-form.php
 *
 * @var yii\web\View $this
 * @var Comments\forms\CommentCreateForm $CommentCreateForm
 */

use fbalabanov\yii\module\Comments;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Comments\widgets\CommentFormWidget $Widget */
$Widget = $this->context;

?>

<a name="commentcreateform"></a>
<div class="row comment-form">
    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-4">
        <?php
        /** @var ActiveForm $form */
        $form = ActiveForm::begin();

        echo Html::activeHiddenInput($CommentCreateForm, 'id');
		echo Html::activeHiddenInput($CommentCreateForm, 'parent_id', ['data-role' => 'new-comment-parent-id']);

        if (\Yii::$app->getUser()->getIsGuest()) {
            echo $form->field($CommentCreateForm, 'from')
                ->textInput();
        }

        $options = [];

        if ($Widget->Comment->isNewRecord) {
            $options['data-role'] = 'new-comment';
        }

        echo $form->field($CommentCreateForm, 'text')
            ->textarea($options);

        ?>
        <div class="actions">
            <?php
            echo Html::submitButton(\Yii::t('app', 'Post comment'), [
                'class' => 'btn btn-primary',
            ]);
            echo Html::resetButton(\Yii::t('app', 'Cancel'), [
                'class' => 'btn btn-link',
            ]);
            ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
</div>