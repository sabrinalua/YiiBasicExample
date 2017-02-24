<?php

namespace app\modules\api;
use Yii;
/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->request->parsers = ['application/json' => '\yii\web\JsonParser'];
        $headers = Yii::$app->response->headers;
        Yii::$app->user->enableSession = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));

        // custom initialization code goes here
    }
}
