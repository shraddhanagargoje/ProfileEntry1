<?php

namespace app\controllers;

use function MongoDB\BSON\fromJSON;
use Yii;
use app\models\entry;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Html;
/**
 * EntryController implements the CRUD actions for entry model.
 */
class EntryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all entry models.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => entry::find()->select('*')->from('Entry AS E')->where(['and','E.status= "0"']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($fname)
    {
        return $this->render('view', [
            'model' => $this->findModel($fname),
        ]);
    }
    public function DisplayBlob($fname){
        $model = new entry();

        return $model->DisplayBlob($fname);

    }

    public function actionCreate()
    {
        $model = new entry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->save();
            $firstname=$model->fname;
            $model->image=UploadedFile::getInstance($model,'image');
            $temp=$firstname.'.'.$model->image->extension;
            $imgname= '../web/uploads/'.$temp;
            $model->image->saveAs($imgname);
            $model->image=$temp;
            $model->save();
            return $this->redirect(['view', 'fname' => $model->fname,'image'=>$model->image]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($fname)
    {
        $model = $this->findModel($fname);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if((UploadedFile::getInstance($model,'image'))!=null){
                $model->image=UploadedFile::getInstance($model,'image');
                $temp=$fname.'.'.$model->image->extension;
                $imgname= '../web/uploads/'.$temp;
                $model->image->saveAs($imgname);
                $model->image=$temp;
            }
            $model->save();

            return $this->redirect(['view', 'fname' => $model->fname,$model->image]);
        }

        return $this->render('update', [
            'model' => $model,$model->image
        ]);
    }

    public function actionDelete($fname)
    {
        $this->findModel($fname)->delete();



        return $this->redirect(['index']);
    }

    /**
     * Finds the entry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return entry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fname)
    {
        if (($model = entry::findOne($fname)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
