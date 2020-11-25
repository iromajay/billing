<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Centers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <p>
        <?= Html::a('Create Center', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'center_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
