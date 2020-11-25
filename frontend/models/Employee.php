<?php

namespace app\models;

use Yii;
use common\models\User;


class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public $name;
    public $user_name;
    public $password;
    public function rules()
    {
        return [
            [['employee_name', 'address', 'phone', 'user_id','center_id', 'created_by','name'], 'required'],
            [['address'], 'string'],
            [[ 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['employee_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 10],
            [['record_status'], 'string', 'max' => 1],
            [['name','user_name','password','user_id'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_name' => 'Employee Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'user_id' => 'User ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'record_status' => 'Record Status',
            'name' => "Role",
            'user_name'=> 'User Name',
            'password' => 'Password'
        ];
    }

    public function signup()
    {
       
        $user = new User();
        $rand_id = rand(10,1000);
        if(!User::findOne($rand_id))
            $user->id = $rand_id;
        $user->username = $this->user_name;

        // $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        // $user->generateEmailVerificationToken();
        if($user->save())
            return  $user->id;
        else {
            print_r($user->errors);
            die;
        }
        return 0;

    }
    public function getUser() {
        return $this->hasOne(User::class,["id"=>'user_id']);

    }
}
