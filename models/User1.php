<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login_id
 * @property string $access_level
 * @property string $password
 */
class User1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_id', 'access_level', 'password'], 'required'],
            [['access_level'], 'string'],
            [['login_id'], 'string', 'max' => 8],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login_id' => 'Login ID',
            'access_level' => 'Access Level',
            'password' => 'Password',
        ];
    }
}
