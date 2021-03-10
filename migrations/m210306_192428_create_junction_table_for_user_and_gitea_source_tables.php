<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_git_source_token}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%git_source}}`
 */
class m210306_192428_create_junction_table_for_user_and_gitea_source_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_git_source_token}}', [
            'user_id' => $this->integer(),
            'git_source_id' => $this->integer(),
            'token' => $this->string(128),
            'PRIMARY KEY(user_id, git_source_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_git_source_token-user_id}}',
            '{{%user_git_source_token}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_git_source_token-user_id}}',
            '{{%user_git_source_token}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `git_source_id`
        $this->createIndex(
            '{{%idx-user_git_source_token-git_source_id}}',
            '{{%user_git_source_token}}',
            'git_source_id'
        );

        // add foreign key for table `{{%git_source}}`
        $this->addForeignKey(
            '{{%fk-user_git_source_token-git_source_id}}',
            '{{%user_git_source_token}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_git_source_token-user_id}}',
            '{{%user_git_source_token}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_git_source_token-user_id}}',
            '{{%user_git_source_token}}'
        );

        // drops foreign key for table `{{%git_source}}`
        $this->dropForeignKey(
            '{{%fk-user_git_source_token-git_source_id}}',
            '{{%user_git_source_token}}'
        );

        // drops index for column `git_source_id`
        $this->dropIndex(
            '{{%idx-user_git_source_token-git_source_id}}',
            '{{%user_git_source_token}}'
        );

        $this->dropTable('{{%user_git_source_token}}');
    }
}
