<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "dummy".
 *
 * @property integer $id
 * @property string $name
 */
class Invoice extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'invoice';
    }

}
?>