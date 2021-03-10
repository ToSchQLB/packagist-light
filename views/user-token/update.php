<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserGitSourceToken */

$this->title = Yii::t('usertoken', 'Update User Git Source Token: {name}', [
    'name' => $model->user_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('usertoken', 'User Git Source Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'git_source_id' => $model->git_source_id]];
$this->params['breadcrumbs'][] = Yii::t('usertoken', 'Update');
?>
<div class="user-git-source-token-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
