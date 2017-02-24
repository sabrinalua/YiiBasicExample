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
class WebUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $ADMIN = 'admin';
    // public $USER = 'user';

    public $ADMIN= 5;
    public $USER =1;
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

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findByUsername($username){
        return static::findOne(['login_id' => $username]);
    }

    public function validatePassword($password){
        return $this->password === $password;
        //if password is hashed use $this->password === md5($password)
        // return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        // throw new NotSupportedException();
        $query = new \yii\db\Query();
        $query->select(['user.*'])
        ->from('user')
        ->join('LEFT JOIN', 'user_org_link', 'user.id=user_org_link.user_id')
        ->where(['user_org_link.role_subtitle'=>$token]);
        $command = $query->createCommand();
        $data = $command->queryAll(); 
        return $data;
    // return static::findOne(['access_token' => $token]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAccess(){
        return $this->access_level;
    }

    public function getAuthKey(){
        return null;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }
}
