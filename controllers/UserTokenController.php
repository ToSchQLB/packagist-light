<?php

namespace app\controllers;

use Yii;
use app\models\UserGitSourceToken;
use app\models\UserGitSourceTokenSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserTokenController implements the CRUD actions for UserGitSourceToken model.
 */
class UserTokenController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all UserGitSourceToken models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new UserGitSourceTokenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGitSourceToken model.
     *
     * @param integer $user_id
     * @param integer $git_source_id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $git_source_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $git_source_id),
        ]);
    }

    /**
     * Creates a new UserGitSourceToken model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGitSourceToken();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'git_source_id' => $model->git_source_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserGitSourceToken model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $user_id
     * @param integer $git_source_id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $git_source_id)
    {
        $model = $this->findModel($user_id, $git_source_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'git_source_id' => $model->git_source_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserGitSourceToken model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $user_id
     * @param integer $git_source_id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $git_source_id)
    {
        $this->findModel($user_id, $git_source_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGitSourceToken model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $user_id
     * @param integer $git_source_id
     *
     * @return UserGitSourceToken the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $git_source_id)
    {
        if (($model = UserGitSourceToken::findOne(['user_id' => $user_id, 'git_source_id' => $git_source_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('usertoken', 'The requested page does not exist.'));
    }
}
