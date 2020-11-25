<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receptionist".
 *
 * @property int $id
 * @property int $name
 * @property string $phone_number
 * @property int $user_id
 * @property string $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Receptionist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receptionist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone_number', 'user_id', 'address', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['name', 'user_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'string'],
            [['phone_number'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'user_id' => 'User ID',
            'address' => 'Address',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
