 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('package', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="package-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('package', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('package', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('package', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'private',
            'name',
            'url:url',
            'route',
            'repo_user',
            'repo_name',
        ],
    ]) ?>

    <?php


    $url = $model->url . 'api/v1/repos/' . $model->route . '/releases';

    echo $url;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOPROXY, 'localhost');

    $output = curl_exec($ch);

    curl_close($ch);

    $releases = json_decode($output, true);

    foreach ($releases as $release) {
        echo "<h3>{$release['name']}</h3>";
        echo "{$release['zipball_url']}<br>";

        $ch = curl_init();

        //$releaseUrl = $url . '/' . $release['id'];
        $composerUrl = "{$model->url}/api/v1/repos/{$model->route}/contents/composer.json?ref={$release['tag_name']}";

        echo $composerUrl;

        curl_setopt($ch, CURLOPT_URL, $composerUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOPROXY, 'localhost');

        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output, true);

        echo '<pre>';
        echo base64_decode($data['content']);
        echo '</pre>';
    }


    ?>

</div>
