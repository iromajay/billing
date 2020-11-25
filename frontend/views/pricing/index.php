<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PricingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pricing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [ 
                'attribute' =>  'franchise_id',
                'value' => function($model) {
                    if(isset($model->franchise->name))
                        return $model->franchise->name;
                    return "SELF";
                }
              ],
            [
                'attribute' => 'center_id',
                'value' => function($model) {
                    return $model->center->center_name;
                }
            ],
            // 'center.center_name',
            'category',
            'price',
            // 'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
