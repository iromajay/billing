<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PatientEntry;

/**
 * PatientEntrySearch represents the model behind the search form of `app\models\PatientEntry`.
 */
class PatientEntrySearch extends PatientEntry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'patient_age', 'price',  'created_at',  'created_by', 'updated_by'], 'integer'],
            [['patient_name', 'gender', 'address', 'template_names', 'template_ids','typist_id','center_id','franchise_id','updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PatientEntry::find();
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        // print_r(strtotime($this->updated_at));die;
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->leftJoin('employee','employee.id=typist_id');
        $query->leftJoin('center','center.id=patient_entry.center_id');
        $query->leftJoin('franchises','franchises.id=patient_entry.franchise_id');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'patient_age' => $this->patient_age,
            'price' => $this->price,
            // 'typist_id' => $this->typist_id,
            'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);



        $query->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'template_names', $this->template_names])
            ->andFilterWhere(['like', 'template_ids', $this->template_ids])
            ->andFilterWhere(['like', 'center_name', $this->center_id])
            ->andFilterWhere(['like', 'franchises.name', $this->franchise_id])
            ->andFilterWhere(['like', 'employee_name', $this->typist_id]);
        if($this->updated_at) {
            // $startDate = $model->start_date;
            // $endDate  = $model->end_date;
            $date=date_create($this->updated_at);
            $endDate = date_add($date,date_interval_create_from_date_string("1 days"));
            $endDate = $endDate->format('Y-m-d');

            $date=date_create($this->updated_at);
            // $startDate = date_sub($date,date_interval_create_from_date_string("1 days"));
            $startDate = $date->format('Y-m-d');

            $query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)]);
            // print_r($startDate);
            // print_r($endDate);die;
        }

        return $dataProvider;
    }
}
