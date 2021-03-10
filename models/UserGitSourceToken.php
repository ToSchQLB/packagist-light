<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_git_source_token".
 *
 * @property int         $user_id
 * @property int         $git_source_id
 * @property string|null $token
 *
 * @property GitSource   $gitSource
 * @property User        $user
 */
class UserGitSourceToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_git_source_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'git_source_id'], 'required'],
            [['user_id', 'git_source_id'], 'integer'],
            [['token'], 'string', 'max' => 128],
            [['user_id', 'git_source_id'], 'unique', 'targetAttribute' => ['user_id', 'git_source_id']],
            [['git_source_id'], 'exist', 'skipOnError' => true, 'targetClass' => GitSource::className(), 'targetAttribute' => ['git_source_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'       => Yii::t('package', 'User ID'),
            'git_source_id' => Yii::t('package', 'Git Source ID'),
            'token'         => Yii::t('package', 'Token'),
        ];
    }

    /**
     * Gets query for [[GitSource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGitSource()
    {
        return $this->hasOne(GitSource::className(), ['id' => 'git_source_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $git_source
     * @param $user
     *
     * @return string|null
     */
    public static function token($git_source, $user)
    {
        return UserGitSourceToken::find()
            ->select('token')
            ->andWhere(['git_source_id' => $git_source])
            ->andWhere(['user_id' => $user])
            ->scalar();
    }
}
