<?php

/* @var $this yii\web\View */

$this->title = 'JKI Packagist';
?>
<div class="site-index">

    <h1>Packagist nutzen <small>ganz einfach und schnell</small></h1>
    <div class="row">
        <div class="col-md-5">

            <p>
                öffne die composer.json in deinem Projekt und füge unter Repositories einfach diesen Eintrag hinzu:
            </p>
            <code lang="json">
                { <br>
                &nbsp;&nbsp;&nbsp;&nbsp;"type": "composer",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"url": "https://packagist.julius-kuehn.de"<br>
                }
            </code>
            <br><br>
            <p>
                Fertig,<br>
                jetzt kannst du ganz normal mit den composer Befehlen alle Pakete dieser Seite nutzen
            </p>
            <br>
            <div class="alert alert-warning">
                Nicht vergessen die Einträge mit Komma zutrennen,<br>
                <b>ABER kein Komma hinter den letzten Eintrag setzen!</b>
            </div>

        </div>
        <div class="col-md-7">
            <?= \yii\helpers\Html::img('images/composer-json.png') ?>
        </div>
    </div>

</div>
