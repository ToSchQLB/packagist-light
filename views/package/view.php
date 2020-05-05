<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('package', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="package-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('package', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('package', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('package', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'gitSource.name',
            [
                'label'=>'Private',
                'format'=>'html',
                'value'=>function($model){
                    if($model->private==0)
                    {
                        return "<span class='glyphicon glyphicon-eye-open text-success'></span>";
                    }else{                  
                        return "<span class='glyphicon glyphicon-ban-circle text-danger'></span>";
                    };
                }
            ],
            // 'private',
            'name',
            'repo_user',
            'repo_name',
        ],
    ]) ?>

    <h2><?= Yii::t('package','Releases') ?></h2>

    <?= Html::ul(\yii\helpers\ArrayHelper::getColumn($model->releases,'version')) ?>
</div>