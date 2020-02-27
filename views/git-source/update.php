<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GitSource */

$this->title = Yii::t('git-source', 'Update Git Source: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('git-source', 'Git Sources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('git-source', 'Update');
?>
<div class="git-source-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
