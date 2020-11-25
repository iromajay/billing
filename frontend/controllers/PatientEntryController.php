<?php

namespace frontend\controllers;

use Yii;
use app\models\PatientEntry;
use app\models\PatientEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Templates;
use app\models\AuthAssignment;
use app\models\Employee;
use app\models\Pricing;
use app\models\Center;
use yii\filters\AccessControl;

/**
 * PatientEntryController implements the CRUD actions for PatientEntry model.
 */
class PatientEntryController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','update','delete','view','centers'],
                        'roles' => ['Admin','Receptionist'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all PatientEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // print_r(Yii::$app->request->queryParams);die;
        $authAssignment = new AuthAssignment();
        $role = $authAssignment->getRole();
        if($role=="Typist") {
            $user_id = Yii::$app->user->id;
            $employee = Employee::find()->where(['user_id'=>$user_id])->one();
            $dataProvider->query->andFilterWhere(['typist_id'=>$employee->id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PatientEntry model.
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
     * Creates a new PatientEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PatientEntry();
        $templates = ArrayHelper::map(Templates::find()->all(),'id','template_name');
        $typists_arr = AuthAssignment::find()->leftJoin('user','user.id=auth_assignment.user_id')->leftJoin('employee','user.id=employee.user_id')->select(['employee_name','employee.id'])->asArray()->where(['item_name'=>'Typist'])->all();
        $typists = [];
        foreach($typists_arr as $key => $value) {
             $typists[$value["id"]] = $value["employee_name"];
        }
        $user_id = Yii::$app->user->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        
        if ($model->load(Yii::$app->request->post())) {
            $totalPrice = $model->PriceMapping($_POST["template_names"],$model->center_id,$model->franchise_id);
            $model->price = isset($totalPrice)?$totalPrice:0;
            // $model->center_id = $employee->center_id;
            // echo "center_id:".$model->center_id;die;
            if($model->save()) {
                Yii::$app->session->setFlash("success","Data has been saved successfully");
                return $this->redirect(['index']);
            }
            else {
                echo "<pre>";print_r($model->errors);echo "<pre>";die;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'templates'=>$templates,
            'typists' => $typists,
            // 'role' => $role,
            // 'centers' => $centers
        ]);
    }

    public function actionCenters($franchise_id) {
        if($franchise_id=='SELF') 
            $centers = ArrayHelper::map(Center::find()->all(),'id','center_name');
        else
            $centers = ArrayHelper::map(Center::find()->where(['franchise_id'=>$franchise_id])->all(),'id','center_name');
        // print_r($centers);
        return json_encode($centers);
    }

    /**
     * Updates an existing PatientEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $templates = ArrayHelper::map(Templates::find()->all(),'id',function($model){
            return $model->template_name;
        });
        $typists_arr = AuthAssignment::find()->leftJoin('user','user.id=auth_assignment.user_id')->leftJoin('employee','user.id=employee.user_id')->select(['employee_name','employee.id'])->asArray()->where(['item_name'=>'Typist'])->all();
        $typists = [];
        foreach($typists_arr as $key => $value) {
             $typists[$value["id"]] = $value["employee_name"];
        }
        $user_id = Yii::$app->user->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $totalPrice = $model->PriceMapping($_POST["template_names"],$model->center_id,$model->franchise_id);
            $model->price = isset($totalPrice)?$totalPrice:0;
            // $model->center_id = $employee->center_id;
            if($model->save()) {
                Yii::$app->session->setFlash("success","Data has been saved successfully");
                return $this->redirect(['index']);
            }
            else {
                echo "<pre>";print_r($model->errors);echo "<pre>";die;
            }
        }
        return $this->render('update', [
            'model' => $model,
            'templates'=>$templates,
            'typists' => $typists,
            // 'role' => $role,
            // 'centers' => $centers
        ]);
    }

    /**
     * Deletes an existing PatientEntry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PatientEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PatientEntry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
