<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = Yii::t('package', 'Update Package: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('package', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('package', 'Update');
?>
<div class="package-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
