<?php

namespace common\models\tables;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\captcha\Captcha;
use yii\db\Expression;


/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property int $role_id
 * @property string $email
 * @property Tasks[] $tasks
 */
class Users extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
//            [['role_id'], 'integer'],
            [['email'], 'email'],
            [['username'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 128],
//            ['password', 'compare'],
            [['email'], 'unique', 'targetClass' => Users::className(), 'message' => 'Данный email уже зарегестрирован'],
            [['username'], 'unique', 'targetClass' => Users::className(), 'message' => 'Этот логин уже занят'],
//            ['verifyCode', 'captcha'],
//            [['password_repeat'], 'required'],
//            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password_hash',
//            'password_repeat' => 'Password_repeat',
            'email' => 'Email',
            'role_id' => 'Role ID',
//            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['responsible_id' => 'id']);
    }

    public function getAddUser()
    {
        $user = new Users();
        $user->username = $this->username;
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password_hash);
        $user->email = $this->email;
        $user->role_id = $this->role_id;
//        return $user->save();
//        var_dump($user->save());
        var_dump($user);
    }


}
