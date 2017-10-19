<?php
/**
 * DemoController.php
 */

namespace fbalabanov\yii\module\Comments\tests\web\controllers;

/**
 * Class DemoController
 * @package fbalabanov\yii\module\Comments\tests\web\controllers
 */
class DemoController extends \yii\web\Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}