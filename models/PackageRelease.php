<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package_release".
 *
 * @property int $id
 * @property int|null $package_id
 * @property string|null $release_id
 * @property string|null $version
 * @property string|null $title
 * @property string|null $body
 * @property string|null $zip_url
 * @property string|null $source_composer_json
 * @property string|null $packagist_json
 *
 * @property Package $package
 */
class PackageRelease extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'package_release';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['package_id'], 'integer'],
            [['body', 'source_composer_json', 'packagist_json'], 'string'],
            [['release_id'], 'string', 'max' => 50],
            [['version'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 255],
            [['zip_url'], 'string', 'max' => 512],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Package::className(), 'targetAttribute' => ['package_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('package', 'ID'),
            'package_id' => Yii::t('package', 'Package ID'),
            'release_id' => Yii::t('package', 'Release ID'),
            'version' => Yii::t('package', 'Version'),
            'title' => Yii::t('package', 'Title'),
            'body' => Yii::t('package', 'Body'),
            'zip_url' => Yii::t('package', 'Zip Url'),
            'source_composer_json' => Yii::t('package', 'Source Composer Json'),
        ];
    }

    /**
     * Gets query for [[Package]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Package::className(), ['id' => 'package_id']);
    }
}
