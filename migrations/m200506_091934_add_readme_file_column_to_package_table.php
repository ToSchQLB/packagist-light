<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%package}}`.
 */
class m200506_091934_add_readme_file_column_to_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'readme_file', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%package}}', 'readme_file');
    }
}
