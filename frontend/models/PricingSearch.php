<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pricing;

/**
 * PricingSearch represents the model behind the search form of `app\models\Pricing`.
 */
class PricingSearch extends Pricing
{
    /**
     * {@inheritdoc}
     */
    public $center_id;
    public function rules()
    {
        return [
            [['id',  'price', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['category','center_id','franchise_id'], 'safe'],
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
        $query = Pricing::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
            // print_r($params);die;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->leftJoin('center','center.id=pricing.center_id');
        $query->leftJoin('franchises','franchises.id=pricing.franchise_id');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'center_id' => $this->center_id,
            'price' => $this->price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category]);
        $query->andFilterWhere(['like', 'center_name', $this->center_id]);
        $query->andFilterWhere(['like', 'franchises.name', $this->franchise_id]);

        return $dataProvider;
    }
}
