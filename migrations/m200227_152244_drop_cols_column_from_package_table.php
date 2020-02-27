<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%package}}`.
 */
class m200227_152244_drop_cols_column_from_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('package', 'url');
        $this->dropColumn('package', 'route');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('package', 'url', $this->string(255)->notNull());
        $this->addColumn('package', 'route', $this->string(255)->notNull());
    }
}
