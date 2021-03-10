<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserGitSourceToken */

$this->title = Yii::t('usertoken', 'Create User Git Source Token');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usertoken', 'User Git Source Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-git-source-token-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
