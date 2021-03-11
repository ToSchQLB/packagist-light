<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HeaderCollection;
use yii\web\NotFoundHttpException;
use app\models\User;
use app\models\PackageRelease;
use app\commands\WorkerController;
use yii\web\Response;

class DownloadController extends Controller
{
    public function actionPrivateRelease($id)
    {
        /** @var HeaderCollection $headers */
        $headers = Yii::$app->request->headers;
        $apiToken = $headers->get('api-token', null);
        if(empty($apiToken)){
            throw new NotFoundHttpException();
        }
        if(User::find()->andWhere(['token_key' => $apiToken])->count() == 0){
            throw new NotFoundHttpException('Invalid API-KEY');
        }
        
        $release = PackageRelease::findOne($id);
        
        if(is_null($release)){
            throw new NotFoundHttpException('Release not found');
        }

        Yii::$app->response->format = Response::FORMAT_RAW;
        $zipFile = WorkerController::curl($release->zip_url);

        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        return $zipFile;

    }
}