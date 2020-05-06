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
            'gitSource.name:text:Quelle',
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
            [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => Html::a($model->name, $model->gitSource->baseUrl . '/' . $model->repo_user . '/' . $model->repo_name)
            ],
            'repo_user',
            'repo_name',
        ],
    ]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">ReadMe</h3>
        </div>
        <div class="panel-body">
            <?php
            $parser = new \cebe\markdown\GithubMarkdown();
            echo $parser->parse($model->readme);
            ?>
        </div>
    </div>



    <h2><?= Yii::t('package','Releases') ?></h2>

    <?= Html::ul(\yii\helpers\ArrayHelper::getColumn($model->releases,'version')) ?>
</div>