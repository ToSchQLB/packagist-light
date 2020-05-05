<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GitSource */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="git-source-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'label'=>yii::t('git-source','name')]) ?>

    <?= $form->field($model, 'baseUrl')->textInput(['maxlength' => true, 'label'=>yii::t('git-source','baseUrl')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('git-source', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
