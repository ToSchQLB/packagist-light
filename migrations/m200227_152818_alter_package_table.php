<?php

use yii\db\Migration;

/**
 * Class m200227_152818_alter_package_table
 */
class m200227_152818_alter_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('package', 'repo_user', $this->string(100)->notNull());
        $this->alterColumn('package', 'repo_name', $this->string(200)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('package', 'repo_user', $this->string(100));
        $this->alterColumn('package', 'repo_name', $this->string(200));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200227_152818_alter_package_table cannot be reverted.\n";

        return false;
    }
    */
}
