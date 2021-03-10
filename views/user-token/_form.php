<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\GitSource;

/* @var $this yii\web\View */
/* @var $model app\models\UserGitSourceToken */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-git-source-token-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::all()) ?>

    <?= $form->field($model, 'git_source_id')->dropDownList(GitSource::all()) ?>

    <?= $form->field($model, 'token')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('usertoken', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
