<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserGitSourceTokenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('usertoken', 'User Git Source Tokens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-git-source-token-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('usertoken', 'Create User Git Source Token'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'git_source_id',
                'value' => 'gitSource.name'
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
