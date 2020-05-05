<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Package */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'git_source_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'label'=>yii::t('packages','name')]) ?>

<div class='row'>
    <div class='col-md-6'>
    <?= $form->field($model, 'repo_user')->textInput(['maxlength' => true,'label'=>yii::t('packages','repo_user')]) ?>
        </div>

    <div class='col-md-6'>
    <?= $form->field($model, 'repo_name')->textInput(['maxlength' => true,'label'=>yii::t('packages','repo_name')]) ?>
        </div>
</div>

    <?= $form->field($model, 'private')->widget(SwitchInput::class,[
        'pluginOptions'=>[
            'onText' => yii::t('app','yes'),
            'offText'=> yii::t('app','no'),
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('package', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
