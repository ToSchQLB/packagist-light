<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%package_release}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%package}}`
 */
class m200227_154553_create_package_release_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%package_release}}', [
            'id' => $this->primaryKey(),
            'package_id' => $this->integer(),
            'release_id' => $this->string(50),
            'version' => $this->string(20),
            'title' => $this->string(255),
            'body' => $this->text(),
            'zip_url' => $this->string(512),
            'source_composer_json' => $this->text(),
        ]);

        // creates index for column `package_id`
        $this->createIndex(
            '{{%idx-package_release-package_id}}',
            '{{%package_release}}',
            'package_id'
        );

        // add foreign key for table `{{%package}}`
        $this->addForeignKey(
            '{{%fk-package_release-package_id}}',
            '{{%package_release}}',
            'package_id',
            '{{%package}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%package}}`
        $this->dropForeignKey(
            '{{%fk-package_release-package_id}}',
            '{{%package_release}}'
        );

        // drops index for column `package_id`
        $this->dropIndex(
            '{{%idx-package_release-package_id}}',
            '{{%package_release}}'
        );

        $this->dropTable('{{%package_release}}');
    }
}
