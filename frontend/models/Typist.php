<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "typist".
 *
 * @property int $id
 * @property int $name
 * @property string $phone_number
 * @property string $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Typist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'typist';
    }

    public function behaviors()
    {
        return[
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }
    public function rules()
    {
        return [
            [['name', 'phone_number', 'address'], 'required'],
            [['name'], 'integer'],
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
            'address' => 'Address',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
