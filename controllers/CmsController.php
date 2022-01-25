<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleContent;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;
use yii\web\UploadedFile;

class CmsController extends Controller
{
    public $layout = 'cms';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
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
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) return $this->redirect('/cms/login');
        $articles = Article::find()->all();
        return $this->render('index',['articles'=>$articles]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/cms/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/cms/index');
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
    public function actionLogout()
    {
        if(Yii::$app->user->isGuest) return $this->redirect('/cms/login');

        Yii::$app->user->logout();

        return $this->redirect('index');
    }

    public function actionCreate()
    {
        if(Yii::$app->user->isGuest) return $this->redirect('/cms/login');

        $model = new Article();
        $content = new ArticleContent();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'thumbnail');
            if($file) {
                $path = Yii::getAlias("@webroot") . "/img/article_thumbs/";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $t = time();
                $file->saveAs($path.$t."$file->name",false);
                $model->thumbnail = "/img/article_thumbs/$t"."$file->name";
            }
            $content->content = Yii::$app->request->post()["Article"]["actual_content"];
            if(!$content->save()) {
                Yii::$app->session->setFlash('error', 'Can\'t save content<br>' . json_encode($content->errors));
                return $this->render('create', ['model'=>$model]);
            }
            $model->content_id = $content->id;
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Model saved<br>');
                return $this->redirect('/cms/index');
            } else {
                Yii::$app->session->setFlash('error', 'Can\'t save model<br>' . json_encode($model->errors));
                return $this->render('create', ['model'=>$model]);
            }
        }
        return $this->render('create', ['model'=>$model]);
    }

    public function actionEdit($id) {
        if(Yii::$app->user->isGuest) return $this->redirect('/cms/login');

        $model = Article::findOne($id);
        $content = ArticleContent::findOne($model->content_id);
        $model->actual_content = $content->content;
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'thumbnail');
            if($file) {
                $path = Yii::getAlias("@webroot") . "/img/article_thumbs/";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $t = time();
                $file->saveAs($path.$t."$file->name",false);
                $model->thumbnail = "/img/article_thumbs/$t"."$file->name";
            }
            $content->content = Yii::$app->request->post()["Article"]["actual_content"];
            if(!$content->save()) {
                Yii::$app->session->setFlash('error', 'Can\'t save content<br>' . json_encode($content->errors));
                return $this->render('edit', ['model'=>$model]);
            }
            $model->content_id = $content->id;
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Model saved<br>');
                return $this->redirect('/cms/index');
            } else {
                Yii::$app->session->setFlash('error', 'Can\'t save model<br>' . json_encode($model->errors));
                return $this->render('edit', ['model'=>$model]);
            }
        }
        return $this->render('edit', ['model'=>$model]);
    }
}
