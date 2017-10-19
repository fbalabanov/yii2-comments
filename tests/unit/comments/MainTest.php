<?php
/**
 * MainTest.php
 */

namespace fbalabanov\yii\module\Comments\tests\unit\comments;

use fbalabanov\yii\module\Comments;

/**
 * Class MainTest
 * @package rmrevin\yii\fontawesome\tests\unit\fontawesome
 */
class MainTest extends Comments\tests\unit\TestCase
{

    public function testMain()
    {
        /** @var Comments\Module $Module */
        $Module = \Yii::$app->getModule('comments');

        $this->assertInstanceOf('fbalabanov\yii\module\Comments\Module', $Module);
        $this->assertEquals('fbalabanov\yii\module\Comments\tests\unit\models\User', $Module->userIdentityClass);
    }
}