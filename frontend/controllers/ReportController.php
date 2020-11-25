<?php

namespace frontend\controllers;
use app\models\PatientEntry;
use app\models\PatientEntrySearch;
use app\models\OrderDetail;
use app\models\StockIn;
use app\models\Report;
use app\models\Employee;
use Yii;
use app\models\Tax;
use app\models\TaxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AuthAssignment;
/**
 * TaxController implements the CRUD actions for Tax model.
 */
class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tax models.
     * @return mixed
     */
    // public function actionIndex()
    // {
     
    //     $model = new Report();
       
    //     $startDate = '';
    //     $endDate = '';
    //     if($model->load(Yii::$app->request->queryParams)) {
    //         $startDate = $model->start_date;
    //         $endDate  = $model->end_date;
           
    //         return $this->render('index', [
    //             // 'searchModel' => $searchModel,
    //             // 'dataProvider' => $dataProvider,
    //             'model' => $model,
    //         ]);
    //     }
    //     return $this->render('_form',['model'=>$model]);
       
    // }

    public function actionIndex()
    {
        $searchModel = new PatientEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Report();
        $startDate = '';
        $endDate = '';
        $sum = 0;
        $authAssignment = new AuthAssignment();
        $role = $authAssignment->getRole();
        if($model->load(Yii::$app->request->queryParams)) {
            $startDate = $model->start_date;
            $endDate  = $model->end_date;
            $date=date_create($endDate);
            $endDate = date_add($date,date_interval_create_from_date_string("1 days"));
            $endDate = $endDate->format('Y-m-d');

            $date=date_create($startDate);
            // $startDate = date_sub($date,date_interval_create_from_date_string("1 days"));
            // print_r($startDate);
            $startDate = $date->format('Y-m-d');
            // echo $startDate;
            // die;
            $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)])->andFilterWhere(['patient_entry.franchise_id'=>$model->franchise_id,'patient_entry.center_id'=>$model->center_id]);
           
            if($role=="Typist") {
                $user_id = Yii::$app->user->id;
                $employee = Employee::find()->where(['user_id'=>$user_id])->one();
                $dataProvider->query->andFilterWhere(['typist_id'=>$employee->id]);
            }
            $sum = $dataProvider->query->sum('price');
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'role' => $role,
                'sum' => $sum
            ]);
        }
        $model->start_date = date('Y-m-d');
        $model->end_date = date('Y-m-d');

        $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'role' => $role,
            'sum' => $sum,

        ]);
    }

    public function actionIndexCopy()
    {
        $searchModel = new PatientEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Report();
        $startDate = '';
        $endDate = '';
        $authAssignment = new AuthAssignment();
        $role = $authAssignment->getRole();
        if($model->load(Yii::$app->request->queryParams)) {
            $startDate = $model->start_date;
            $endDate  = $model->end_date;
            $date=date_create($endDate);
            $endDate = date_add($date,date_interval_create_from_date_string("1 days"));
            $endDate = $endDate->format('Y-m-d');

            $date=date_create($startDate);
            // $startDate = date_sub($date,date_interval_create_from_date_string("1 days"));
            // print_r($startDate);
            $startDate = $date->format('Y-m-d');
            // echo $startDate;
            // die;
            $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)])->andFilterWhere(['patient_entry.franchise_id'=>$model->franchise_id,'patient_entry.center_id'=>$model->center_id]);
           
            if($role=="Typist") {
                $user_id = Yii::$app->user->id;
                $employee = Employee::find()->where(['user_id'=>$user_id])->one();
                $dataProvider->query->andFilterWhere(['typist_id'=>$employee->id]);
            }

            return $this->render('index_copy', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'role' => $role,
            ]);
        }
        $model->start_date = date('Y-m-d');
        $model->end_date = date('Y-m-d');

        $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)]);

        return $this->render('index_copy', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'role' => $role
        ]);
    }

    public function actionFrachise()
    {
        $searchModel = new PatientEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Report();
        $startDate = '';
        $endDate = '';
        $authAssignment = new AuthAssignment();
        $role = $authAssignment->getRole();
        if($model->load(Yii::$app->request->queryParams)) {
            $startDate = $model->start_date;
            $endDate  = $model->end_date;
            $date=date_create($endDate);
            $endDate = date_add($date,date_interval_create_from_date_string("1 days"));
            $endDate = $endDate->format('Y-m-d');

            $date=date_create($startDate);
            // $startDate = date_sub($date,date_interval_create_from_date_string("1 days"));
            // print_r($startDate);
            $startDate = $date->format('Y-m-d');
            // echo $startDate;
            // die;
            $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)])->andFilterWhere(['patient_entry.franchise_id'=>$model->franchise_id,'patient_entry.center_id'=>$model->center_id]);
           
            if($role=="Typist") {
                $user_id = Yii::$app->user->id;
                $employee = Employee::find()->where(['user_id'=>$user_id])->one();
                $dataProvider->query->andFilterWhere(['typist_id'=>$employee->id]);
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'role' => $role,
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'role' => $role
        ]);
    }
    
    public function actionTypist()
    {
        $searchModel = new PatientEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Report();
        $startDate = '';
        $endDate = '';
        $authAssignment = new AuthAssignment();
        $role = $authAssignment->getRole();
        $sum = 0;
        $typists_arr = AuthAssignment::find()->leftJoin('user','user.id=auth_assignment.user_id')->leftJoin('employee','user.id=employee.user_id')->select(['employee_name','employee.id'])->asArray()->where(['item_name'=>'Typist'])->all();
        $typists = [];
        foreach($typists_arr as $key => $value) {
             $typists[$value["id"]] = $value["employee_name"];
        }
        if($model->load(Yii::$app->request->queryParams)) {
            $startDate = $model->start_date;
            $endDate  = $model->end_date;
            $date=date_create($endDate);
            $endDate = date_add($date,date_interval_create_from_date_string("1 days"));
            $endDate = $endDate->format('Y-m-d');

            $date=date_create($startDate);
            // $startDate = date_sub($date,date_interval_create_from_date_string("1 days"));
            // print_r($startDate);
            $startDate = $date->format('Y-m-d');
            // echo $startDate;
            // die;
            $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)])->andFilterWhere(['patient_entry.franchise_id'=>$model->franchise_id,'patient_entry.center_id'=>$model->center_id])->andFilterWhere(['typist_id'=>$model->typist_id]);
           
            if($role=="Typist") {
                $user_id = Yii::$app->user->id;
                $employee = Employee::find()->where(['user_id'=>$user_id])->one();
                $dataProvider->query->andFilterWhere(['typist_id'=>$employee->id]);
            }
            $sum = $dataProvider->query->sum('price');
            return $this->render('typist', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'role' => $role,
                'typists'=>$typists,
                'sum' => $sum,
            ]);
        }
        $model->start_date = date('Y-m-d');
        $model->end_date = date('Y-m-d');

        $dataProvider->query->andFilterWhere(['between','patient_entry.updated_at',strtotime($startDate),strtotime($endDate)]);

        return $this->render('typist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'role' => $role,
            'typists'=>$typists,
            'sum'=>$sum
        ]);
    }

    public function actionOptions()
    {
        return $this->render('options');
    }

    /**
     * Displays a single Tax model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tax model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tax();

         if ($model->load(Yii::$app->request->post()) ) {
            $model->tax_name = strtoupper($model->tax_name);
            $model->created_by = 1;//Yii::$app->user->id;
            if(!$model->save()){
                print_r($model->errors);die;
                Yii::$app->session->setFlash('danger', 'Failed to Add Tax!');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('success', 'Tax Successfully Added!');
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tax model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tax model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model = $this->findModel($id);
       $model->record_status='0';
       $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tax model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tax the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tax::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
