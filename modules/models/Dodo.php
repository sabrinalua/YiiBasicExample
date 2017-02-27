<?php
namespace app\modules\models;
use Yii;

//class for fetching/viewing Invoice 
class Dodo
{
	//@var $partyCode string or int
	//@var $offset int
	public function getAll($rceiverId, $offset=0){
		$invoice= Invoice::find()->leftJoin('party', 'invoice.invoice_no = party.invoice_no')->groupBy('invoice.invoice_no')->where(['party.party_code'=>$receiverId])->offset($offset)->limit(10)->orderBy(['invoice.invoice_no'=>SORT_DESC])->all();

		$teal = Invoice::find()->where(['receiver_b2be_id'=>$partyCode])->offset($offset)->limit(10)->orderBy(['receiver_b2be_id'=>SORT_DESC]);

		$array =[];
		foreach ($invoice as $i) {
			$temp = self::getById($i->invoice_id);
			array_push($array, $temp);
		}
		return $array;
	}

	public function getById($invoiceId){
		$invoice = Invoice::findOne(['invoice_id'=>$invoiceId]);
		$array = [
			'invoice_id' => $invoice->invoice_id,
			'invoice_no' =>$invoice->invoice_no,
			'party'=>Party::find()->where(['invoice_no'=>$invoice->invoice_no])->all(),
		];
		return $array;
	}

	public function getByRcId($invoiceId,$receiverId){
		$invoice = Invoice::findOne(['invoice_id'=>$invoiceId, 'receiver_b2be_id'=>$receiverId]);
		$array =[];
		if(sizeof($invoice)==1){
				$array = [
				'invoice_id' => $invoice->invoice_id,
				'invoice_no' =>$invoice->invoice_no,
				'party'=>Party::find()->where(['invoice_no'=>$invoice->invoice_no])->all(),
			];
		}
		return $array;
	}

	public function getAllWithParameters($receiverId, $type = 'new', $offset=0){
		$array=[];
		switch ($type) {
			case 'new':
				$array=['status'=>'new', 'receiver_b2be_id'=>$receiverId];
				break;
			case 'pending':
				$array=['status'=>'pending', 'receiver_b2be_id'=>$receiverId];
				break;
			case 'overdue':
				$array=['status'=>'overdue', 'receiver_b2be_id'=>$receiverId];
				break;
			case 'starred':
				$array=['starred'=>1, 'receiver_b2be_id'=>$receiverId];
				break;
			default:
				# code...
				break;
		}
		$return = self::getAllWithParametersAsArray($array, $offset);
		return $return;
	}

	public function getAllWithParametersAsArray($array, $offset){
		//array includes receiverId
		$invoice = Invoice::find()->where($array)->orderBy()->limit(10)->offset($offset)->all();
		$array =[];
		foreach ($invoice as $i) {
			$temp = self::getById($i->invoice_id);
			array_push($array, $temp);
		}
		return $array;
	}


}
?>