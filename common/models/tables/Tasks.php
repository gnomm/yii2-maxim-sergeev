<?php

namespace common\models\tables;

use common\events\SentTaskMailEvent;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $name
 * @property string $description
 * @property string $date
 * @property int $responsible_id
 * @property int $initiator_id
 * @property Users $user
 * @var $image UploadedFile
 * */
class Tasks extends \yii\db\ActiveRecord
{

//    public $image;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['responsible_id'], 'integer'],
            [['initiator_id'], 'integer'],
            [['name', 'description'], 'string'],
            [['date'], 'safe'],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['responsible_id' => 'id']],
            [['initiator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['initiator_id' => 'id']],
//            [['date'], 'default', 'value' => date('Y-m-d:H:i:s')],
            [['date'], 'default', 'value' => new Expression('NOW()')],
//            [['date'], 'default', 'value' => Tasks::find()->],
            [['image'], 'file', 'extensions' => 'jpg, png'],
            [['date'], 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>='],
//            [['date'], 'compare', 'compareValue' => new Expression('NOW()'), 'operator' => '>='],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'date' => 'Date',
            'responsible_id' => 'User ID',
            'initiator_id' => 'User ID',
            'image' => 'Image'
//            'created_at' => 'Created_at',
//            'updated_at' => 'Updated_at'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'responsible_id']);
    }

    public static function getTaskCurrentMonth($month, $id)
    {
        return static::find()
            ->where(["MONTH(date)" => $month, "responsible_id" => $id])//            ->with('user')
            ;

//        $tasks = \Yii::$app->db->createCommand("
//        SELECT * FROM tasks WHERE MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW())
//         ")
//            ->queryAll();
//        return $tasks;
    }

    public static function getUsers($id)
    {
        return static::find()
            ->where(['responsible_id' => $id])
            ->all();
    }

    public static function getUserEmail($event)
    {
        return static::find()
            ->where(['responsible_id' => $event->sender->responsible_id])
            ->with('user')
            ->one();
    }


    public static function getUserEmail2($id)
    {
        return static::find()
            ->where(['responsible_id' => $id])
            ->with('user')
            ->one();
    }


    public function upload()
    {
        if ($this->validate()) {
            $basename = $this->image->getBaseName() . "." . $this->image->getExtension();
            $filename = '@webroot/uploadImg/' . $basename;
            $this->image->saveAs(\Yii::getAlias($filename));

            Image::thumbnail($filename, 100, 100)
                ->save(\Yii::getAlias('@webroot/uploadImg/small/' . $basename));
        }
        return false;
    }
}
