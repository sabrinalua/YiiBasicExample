<?php

namespace app\modules\api\controllers;
use Yii;
use app\modules\models\Dummy;
use app\modules\models\Invoice;

use app\modules\models\Dodo;

use yii\rest\Controller;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

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
        $issetUserAgent = isset($headers['user-agent']) ? 1 : 0;
        
        $_bc_dev_id = isset($headers['CUSTOM_HEADER']) ? 1 : 0;
        $server_allowed = (strcasecmp($server, $server_const))==0 ? 1 : 0; 

        if($action->id == "index"){
            $bool = true;
        }else{
            if($_bc_dev_id and $server_allowed and $issetUserAgent){
            $bool = true;
            }else{
                // throw new \yii\web\ForbiddenHttpException();
                throw new \yii\web\HttpException(403, "You are not allowed access to this endpoint");
            }
        }        
        return $bool; // or false to not run the action
    }

    public function actionIndex()
    {	Yii::$app->response->statusCode =403;
        $query = Invoice::find();
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);
        $receiverId = '2';
        $data = Dodo::getAll($receiverId);
        return $data;

        // return $headers =Yii::$app->request->headers['user-agent'];
    }

}
