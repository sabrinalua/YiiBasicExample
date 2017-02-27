<?php
namespace app\modules\models;
use Yii;

class Party extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'party';
    }
}
?>