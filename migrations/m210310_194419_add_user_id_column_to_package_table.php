<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%package}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210310_194419_add_user_id_column_to_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'user_id', $this->integer());

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-package-user_id}}',
            '{{%package}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-package-user_id}}',
            '{{%package}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-package-user_id}}',
            '{{%package}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-package-user_id}}',
            '{{%package}}'
        );

        $this->dropColumn('{{%package}}', 'user_id');
    }
}
