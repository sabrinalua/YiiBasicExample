<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_org_link".
 *
 * @property integer $link_id
 * @property integer $user_id
 * @property integer $org_id
 * @property integer $role_level
 * @property string $role_subtitle
 */
class UserOrgLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_org_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'org_id', 'role_level', 'role_subtitle'], 'required'],
            [['user_id', 'org_id', 'role_level'], 'integer'],
            [['role_subtitle'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'user_id' => 'User ID',
            'org_id' => 'Org ID',
            'role_level' => 'Role Level',
            'role_subtitle' => 'Role Subtitle',
        ];
    }
}
