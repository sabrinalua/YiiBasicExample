<?php

namespace app\modules\api\controllers;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    public function beforeAction($action){
        $bool = false;
        $server_const = "localhost";
        
        $headers =Yii::$app->request->headers;
        $server = Yii::$app->request->getServerName();
        
        $_bc_dev_id = isset($headers['CUSTOM_HEADER']) ? 1 : 0;
        $server_allowed = (strcasecmp($server, $server_const))==0 ? 1 : 0; 

        if($action->id == "index"){
            $bool = true;
        }else{
            if($_bc_dev_id and $server_allowed){
            $bool = true;
            }else{
                // throw new \yii\web\ForbiddenHttpException();
                throw new \yii\web\HttpException(403, "You are not allowed access to this endpoint");
            }
        }        
        return $bool; // or false to not run the action
    }

    public function actionIndex()
    {	Yii::$app->response->statusCode =400;
        return [1,2,3];
    }
}
