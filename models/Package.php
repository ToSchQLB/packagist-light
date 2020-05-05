<?php

namespace app\models;

use app\jobs\PackageSyncJob;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "package".
 *
 * @property int              $id
 * @property int              $git_source_id
 * @property int|null         $private
 * @property string           $name
 * @property string           $repo_user
 * @property string           $repo_name
 *
 * @property GitSource        $gitSource
 * @property PackageRelease[] $releases
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
            [['git_source_id', 'name', 'repo_user', 'repo_name'], 'required'],
            [['git_source_id', 'private'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['repo_user'], 'string', 'max' => 100],
            [['repo_name'], 'string', 'max' => 200],
            [
                ['git_source_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => GitSource::className(),
                'targetAttribute' => ['git_source_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('package', 'ID'),
            'git_source_id' => Yii::t('package', 'Git Source ID'),
            'private'       => Yii::t('package', 'Private'),
            'name'          => Yii::t('package', 'Package Name'),
            'repo_user'     => Yii::t('package', 'Repository User'),
            'repo_name'     => Yii::t('package', 'Repository Name'),
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
     * Gets query for [[PackageRelease]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleases()
    {
        return $this->hasMany(PackageRelease::class, ['package_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $job = new PackageSyncJob();
            $job->packageId = $this->id;
            Yii::$app->queue->push($job);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
    /**
     * all
     * @param string $value 
     * @return object
     */
    public function all($name,$value){
        return ArrayHelper::map(Package::find()

        ->addOrderBy(['name'=>SORT_ASC])
        
        ->all(),$name,$value);
    }

}
