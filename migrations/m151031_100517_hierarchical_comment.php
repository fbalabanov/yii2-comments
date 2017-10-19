<?php

use yii\db\Migration;
use yii\db\Schema;

class m151031_100517_hierarchical_comment extends Migration
{

    public function up()
    {
        $this->addColumn('{{%comment}}', 'parent_id', Schema::TYPE_INTEGER . ' AFTER [[id]]');
		$this->addColumn('{{%comment}}', 'lineage', Schema::TYPE_STRING . ' AFTER [[updated_at]]');
		$this->addColumn('{{%comment}}', 'depth', Schema::TYPE_INTEGER . ' not null default 0 AFTER [[lineage]]');
    }

    public function down()
    {
        $this->dropColumn('{{%comment}}', 'parent_id');
		$this->dropColumn('{{%comment}}', 'lineage');
		$this->dropColumn('{{%comment}}', 'depth');
    }
}
