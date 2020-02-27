<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'git_source_id') ?>

    <?= $form->field($model, 'private') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'repo_user') ?>

    <?php // echo $form->field($model, 'repo_name') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('package', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('package', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
