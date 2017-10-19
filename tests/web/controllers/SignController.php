<?php
/**
 * SignController.php
 */

namespace fbalabanov\yii\module\Comments\tests\web\controllers;

use fbalabanov\yii\module\Comments\tests\web\models\User;

/**
 * Class SignController
 * @package fbalabanov\yii\module\Comments\tests\web\controllers
 */
class SignController extends \yii\web\Controller
{

    /**
     * @return \yii\web\Response
     */
    public function actionIn()
    {
        /** @var User $User */
        $User = User::find()->one();

        \Yii::$app->getUser()->login($User);

        return $this->redirect(['/demo/index']);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionOut()
    {
        \Yii::$app->getUser()->logout();

        return $this->redirect(['/demo/index']);
    }
}