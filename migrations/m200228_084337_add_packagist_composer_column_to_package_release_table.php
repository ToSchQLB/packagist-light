<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%package_release}}`.
 */
class m200228_084337_add_packagist_composer_column_to_package_release_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package_release}}', 'packagist_json', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%package_release}}', 'packagist_json');
    }
}
