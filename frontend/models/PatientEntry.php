<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use app\models\Employee;
/**
 * This is the model class for table "patient_entry".
 *
 * @property int $id
 * @property string $patient_name
 * @property int $patient_age
 * @property string $gender
 * @property string $address
 * @property string $template_names
 * @property string $template_ids
 * @property int $price
 * @property int $typist_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class PatientEntry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $asd;
    public static function tableName()
    {
        return 'patient_entry';
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
    public function rules()
    {
        return [
            [['patient_name', 'franchise_id','center_id'  ], 'required'],
            [['patient_age', 'price'], 'integer'],
            [['gender', 'address','franchise_id'], 'string'],
            [['patient_name',  'template_ids','typist_id','date'], 'string', 'max' => 255],
            [['center_id', 'patient_age', 'gender','date', 'address',],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_name' => 'Patient Name',
            'patient_age' => 'Patient Age',
            'gender' => 'Gender',
            'address' => 'Address',
            'template_names' => 'Template Names',
            'template_ids' => 'Template Ids',
            'price' => 'Price',
            'typist_id' => 'Typist',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'center_id' => 'Center',
            'franchise_id' => 'Franchise',
        ];
    }
    public function PriceMapping($templates,$center_id,$franchise_id){
        // echo $center_id;
       $catgoryPricing = ArrayHelper::map(Pricing::find()->where(['center_id'=>$center_id])->all(),'category','price');
       $tempCategory = ArrayHelper::map(Templates::find()->all(),'id','category');
       $tempIdName = ArrayHelper::map(Templates::find()->all(),'id','template_name');
       $totalPrice = 0;
       $category = 0;
       $price = 0;
       // $test= Pricing::find()->select("*")->asArray()-> where(['center_id'=>$center_id])->all();
    //    echo "<pre>";print_r($catgoryPricing);echo "<pre>";die;
    //    echo "<pre>";print_r($test);echo "<pre>";die;
       $this->template_ids = "";
       $this->template_names = "";
       foreach($templates as $key=>$value) {
           if(isset($tempCategory[$value]))
               $category = $tempCategory[$value];
           if(isset($catgoryPricing[$category]))
               $price = $catgoryPricing[$category];
           // echo "category:".$category;
           // echo "pric:".$price;
           $totalPrice += $price;
           $this->template_ids = $this->template_ids.strval($value).",";
           $this->template_names = $this->template_names.$tempIdName[$value].",";

       }
       $this->template_ids = rtrim($this->template_ids,",");
       $this->template_names = rtrim($this->template_names,",");
    //    echo $totalPrice;die;
       return $totalPrice;
   }

   public function getTypist()
   {
       return $this->hasOne(Employee::class,['id'=>'typist_id']);
   }
   public function getCenter()
   {
       return $this->hasOne(Center::class,['id'=>'center_id']);
   }
   public function getFranchise()
   {
       return $this->hasOne(Franchises::class,['id'=>'franchise_id']);
   }
}
