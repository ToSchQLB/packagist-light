<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserGitSourceTokenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-git-source-token-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'git_source_id') ?>

    <?= $form->field($model, 'token') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('usertoken', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('usertoken', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
