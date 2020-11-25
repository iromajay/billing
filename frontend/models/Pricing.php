<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\models\Center;
/**
 * This is the model class for table "pricing".
 *
 * @property int $id
 * @property int $center_id
 * @property string $cateogory
 * @property int $price
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Pricing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pricing';
    }

    public function behaviors()
    {
        return[
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }
    /**
     * {@inheritdoc}
     */
    public $ctType1Price,$ctType2Price,$ctType3Price,$ctType4Price,$ctType5Price;
    public $MRI1Price,$MRI2Price,$MRI3Price;
    public $XRAY1Price,$XRAY2Price,$XRAY3Price,$XRAY4Price,$XRAY5Price;
    public function rules()
    {
        return [
            [['center_id', 'franchise_id', 'ctType1Price','ctType2Price','ctType3Price','ctType4Price','ctType5Price','MRI1Price','MRI2Price','MRI3Price','XRAY1Price','XRAY2Price','XRAY3Price','XRAY4Price','XRAY5Price'], 'required'],
            [[ 'price','ctType1Price','ctType2Price','ctType3Price','ctType4Price','ctType5Price','MRI1Price','MRI2Price','MRI3Price','XRAY1Price','XRAY2Price','XRAY3Price','XRAY4Price','XRAY5Price'], 'integer'],
            [[ 'price','ctType1Price','ctType2Price','ctType3Price','ctType4Price','ctType5Price','MRI1Price','MRI2Price','MRI3Price','XRAY1Price','XRAY2Price','XRAY3Price','XRAY4Price','XRAY5Price'], 'default','value'=>0],
            [['category','center_id','franchise_id'], 'string'],
            [['price','category'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'center_id' => 'Center',
            'franchise_id' => 'Franchise',
            'cateogory' => 'Cateogory',
            'price' => 'Price',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ctType1Price' => " CT-Type-1 Price",
            'ctType2Price' => " CT-Type-2 Price",
            'ctType3Price' => " CT-Type-3 Price",
            'ctType4Price' => " CT-Type-4 Price",
            'ctType5Price' => " CT-Type-5 Price",
            'MRI1Price' => "MRI-Type-1 Price",
            'MRI2Price' => "MRI-Type-2 Price",
            'MRI3Price' => "MRI-Type-3 Price",
            'XRAY1Price' => "XRAY-Type-1 Price",
            'XRAY2Price' => "XRAY-Type-2 Price",
            'XRAY3Price' => "XRAY-Type-3 Price",
            'XRAY4Price' => "XRAY-Type-4 Price",
            'XRAY5Price' => "XRAY-Type-5 Price",
        ];
    }

    public function getCenter(){
        return $this->hasOne(Center::class,['id'=>'center_id']);        
    }

    public function getFranchise()
   {
       return $this->hasOne(Franchises::class,['id'=>'franchise_id']);
   }
    
}
