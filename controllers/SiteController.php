<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\WebUser;
use app\models\UserOrgLink;
use Jabran\CSV_Parser;
use app\models\ExModel;
use yii\helpers\Json;



class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' =>['contact'],
                        'allow'=> true,
                        'matchCallback'=> function(){
                            $bool = false;
                            if(!Yii::$app->user->isGuest){
                                $bool = (int)Yii::$app->session->get('user.access_lv') == (int)Yii::$app->user->identity->ADMIN;
                                
                            }
                            return $bool;
                        }
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
     * @inheritdoc
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

    public function actionIndex(){
        $ex = new ExModel();
        $ex->user_id = 1;
        $k = $ex->getLinks();
        // $user = $k->user;
        var_dump(Json::encode($k));

        // return $this->render('index');
    }
    public function actionIndexk()
    {
        // echo "sesh".(int)Yii::$app->session->get('user.access_level');
        // echo "<br>admin".(int)Yii::$app->user->identity->ADMIN;
        $csv_path = (__DIR__).'/sample_invoice_v1.csv';
        $csv = new CSV_Parser();
        $csv->fromPath($csv_path);
        $array =$csv->parse(false);
        $new =[];
        $i=0;
        foreach ($array as $a){
            $i++;
            $bool = $a[0]==NULL? true:false;
            if(!$bool){
                array_push($new, $a);
            }
        }
        var_dump($new);

       // return $this->render('index');
    }

    public function actionIndex2(){

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $user = WebUser::findOne(['login_id'=>$model->username]);
            $link = UserOrgLink::findOne(['user_id'=>$user->id]);
            $role = $link->role_level;
            $role_name = $link->role_subtitle;
            Yii::$app->session->set('user.access_lv',$role);
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
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
    public function actionAbout()
    {
        return $this->render('about');
    }
}
