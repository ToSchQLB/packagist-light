<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%package}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%git_source}}`
 */
class m200227_152141_add_git_source_id_column_to_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'git_source_id', $this->integer()->notNull()->after('id'));

        // creates index for column `git_source_id`
        $this->createIndex(
            '{{%idx-package-git_source_id}}',
            '{{%package}}',
            'git_source_id'
        );

        // add foreign key for table `{{%git_source}}`
        $this->addForeignKey(
            '{{%fk-package-git_source_id}}',
            '{{%package}}',
            'git_source_id',
            '{{%git_source}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%git_source}}`
        $this->dropForeignKey(
            '{{%fk-package-git_source_id}}',
            '{{%package}}'
        );

        // drops index for column `git_source_id`
        $this->dropIndex(
            '{{%idx-package-git_source_id}}',
            '{{%package}}'
        );

        $this->dropColumn('{{%package}}', 'git_source_id');
    }
}
