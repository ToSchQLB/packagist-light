<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%package}}`.
 */
class m200506_090609_add_readme_column_to_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'readme', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%package}}', 'readme');
    }
}
