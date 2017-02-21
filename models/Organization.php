<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $org_id
 * @property string $org_name
 * @property string $org_address
 * @property string $org_contact
 * @property string $org_fax
 * @property string $org_email
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_name', 'org_address', 'org_contact', 'org_fax', 'org_email'], 'required'],
            [['org_name', 'org_address', 'org_contact', 'org_fax', 'org_email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'org_id' => 'Org ID',
            'org_name' => 'Org Name',
            'org_address' => 'Org Address',
            'org_contact' => 'Org Contact',
            'org_fax' => 'Org Fax',
            'org_email' => 'Org Email',
        ];
    }
}
