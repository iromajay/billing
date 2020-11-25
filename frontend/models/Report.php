<?php
namespace app\models;
use Yii;

class Report extends  \yii\base\Model
{
    public $start_date,$end_date,$center_id,$franchise_id,$typist_id;
    public function rules()
    {
        return [
            [['start_date','end_date','franchise_id'], 'string', 'max' => 255],
            [['center_id'],'integer'],
            [['franchise_id','center_id','typist_id'],'safe'],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'franchise_id' => 'Franchise',
            'center_id' => 'Center',
            'typist_id' => 'Typist'
        ];
    }
}
