<?php
namespace app\models;

use Yii;

use yii\base\Model;
use yii\web\Linkable;
use app\models\User1;
use app\models\UserOrgLink;
use yii\helpers\Json;

class ExModel extends Model implements Linkable{
	public $user_id;

	public function fields(){
		return ['user'];
	}

	public function extraFields(){
		return ['role'];
	}

	public function getLinks(){
		$id=$this->user_id;
		return[
		'user'=>User1::findOne(['id'=>$id]),
		'role'=>UserOrgLink::find()->where(['user_id'=>$id])->all(),

		];
	}


}
?>