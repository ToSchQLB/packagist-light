<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\GitSource;
use app\models\Package;

use kartik\select2\Select2;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('package', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('package', 'Create Package'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'git_source_id',
            [
                'attribute'=>'git_source',
                'value'=>function($model){
                    return $model->gitSource->name;
                    },
                'filter'=>Select2::widget([
                    'data'=>GitSource::all(),
                    'name'=>'PackageSearch[git_source]',
                    'value'=>$searchModel->git_source,
                    'options'=>[
                        'placeholder'=>''
                    ]
                ]),
                'header'=>yii::t('packages','git_source')
                
            ],
            // 'private',
            [
                'attribute'=>'private',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->private==0)
                    {
                        return "<span class='glyphicon glyphicon-eye-open text-success'></span>";
                    }else{                  
                        return "<span class='glyphicon glyphicon-ban-circle text-danger'></span>";
                    };
                },
                'filter'=>['0'=>yii::t('app','no'),'1'=>yii::t('app','yes')],
            ],
            'repo_name',
            
            'repo_user',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
