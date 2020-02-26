<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property int $id
 * @property int|null $private
 * @property string $name
 * @property string|null $url
 * @property string|null $route
 * @property string|null $repo_user
 * @property string|null $repo_name
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'package';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['private'], 'integer'],
            [['name'], 'required'],
            [['name', 'url', 'route', 'repo_user', 'repo_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('package', 'ID'),
            'private' => Yii::t('package', 'Private'),
            'name' => Yii::t('package', 'Name'),
            'url' => Yii::t('package', 'Url'),
            'route' => Yii::t('package', 'Route'),
            'repo_user' => Yii::t('package', 'Repo User'),
            'repo_name' => Yii::t('package', 'Repo Name'),
        ];
    }
}
