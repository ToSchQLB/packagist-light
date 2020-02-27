<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GitSource */

$this->title = Yii::t('git-source', 'Create Git Source');
$this->params['breadcrumbs'][] = ['label' => Yii::t('git-source', 'Git Sources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="git-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
