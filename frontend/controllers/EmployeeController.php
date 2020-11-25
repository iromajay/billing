<?php

namespace frontend\controllers;

use Yii;
use app\models\Employee;
use app\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\DbManager;
use yii\filters\AccessControl;
use app\models\AuthAssignment;
use common\models\User;
/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
                        'actions' => ['index','create','update','view'],
                        'roles' => ['Admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
            $user_id = $model->signup();
            if(!$user_id){
                // Yii::$app->session->set('toast', 'Failed to create user');
                Yii::$app->session->setFlash('danger', 'Failed to create user');

            }
            else {
                $auth = new DbManager;
                $auth->init();
                $role = $auth->getRole($model->name);
                // echo $model->name;
                // echo "<pre>";
                // print_r($role);
                // echo "</pre>";
                // die;
                $auth->assign($role, $user_id);
                $model->user_id = $user_id;
                $model->created_by = Yii::$app->user->id;
                if($model->save()) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'User created Successfull !!');
                }
                else{
                    Yii::$app->session->setFlash("danger","Failed to create user, some error has occured");
                    $transaction->rollback();
                    print_r($model->errors);die;
                }
                return $this->redirect(['employee/index']);
            } 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $authAssign = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
            // $us
            $auth = new DbManager;
            $auth->init();
            $authAssign->find()->where(['user_id'=>$model->user_id])->one();
            $authAssign->item_name = $model->name;
            $authAssign->save();
            $model->updated_by = Yii::$app->user->id;
            $model->user_id= strval($model->user_id);
            $user = User::findOne($model->user_id);
            $user->setPassword($model->password);
            $user->save();
            if($model->save()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'User updated Successfull !!');
            }
            else{
                Yii::$app->session->setFlash("danger","Failed to create user, some error has occured");
                $transaction->rollback();
                print_r($model->errors);die;
            }
            return $this->redirect(['employee/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
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


    public function actionResetpassword($id){
        $employee = $this->findModel($id);
        $user = \common\models\User::findOne($employee->user_id);
        if ($employee->load(Yii::$app->request->post()) ) {
            $user->setPassword($employee->password);
            $user->save();
            Yii::$app->session->setFlash("success","Password reset successfully");
            return $this->redirect(['employee/index']);
        }
        return $this->render('_resetPassword', [
            'model' => $employee,
        ]);
        
    }
    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
