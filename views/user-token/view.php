<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserGitSourceToken */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('usertoken', 'User Git Source Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-git-source-token-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('usertoken', 'Update'), ['update', 'user_id' => $model->user_id, 'git_source_id' => $model->git_source_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('usertoken', 'Delete'), ['delete', 'user_id' => $model->user_id, 'git_source_id' => $model->git_source_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('usertoken', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'git_source_id',
        ],
    ]) ?>

</div>
