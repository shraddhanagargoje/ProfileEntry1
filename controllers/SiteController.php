<?php

namespace app\controllers;
use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\EntryForm;
use yii\grid\GridView;
use yii\widgets\ListView;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

     function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
     function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

     /*function actionDataWidget() {
        $model = EntryForm::find()->one();
        return $this->render('datawidget', [
            'model' => $model
        ]);
    }*/
    public function actionDelete($id) {
        $this->EntryForm($id)->delete();
        return $this->redirect(['index']);
    }
     function attributeLabel(){}
     function actionIndex()
    {	$query=EntryForm::find()->select(['e.fname', 'e.lname', 'e.email', 'e.marks', 'e.status'])->from(['entry as e'])->
    where(['and','e.fname IS NOT NULL']);

        //$model=EntryForm::find()->
      /* 	 $query = new Query;
        $query=EntryForm::find()->asArray();
		$query=EntryForm::find()->select(['e.fname', 'e.lname', 'e.email', 'e.marks', 'e.status'])->from(['entry as e'])->where(['and','e.fname IS NOT NULL']);
	*/	$provider = new ActiveDataProvider([
					'query' => EntryForm::find()->asArray(),

        ]);

       	return $this->render('index',['provider'=>$provider]);
   
	}
     function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
     function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
     function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
     function actionAbout()
    {
        return $this->render('about');
    }
	
	 function actionSay($message = ’Hello’)
{
return $this->render(’say’, [’message’ => $message]);
}

 function actionEntry()
{
$model = new EntryForm();
if ($model->load(Yii::$app->request->post()) && $model->validate())
{
			 $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
				if ($model->upload()) {
						return $this->render('entry-confirm', ['model' => $model]);
					
				}
		
} else {
// either the page is initially displayed or there is some validation error
return $this->render('entry', ['model' => $model]);
}
}
}
