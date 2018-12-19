<?php

namespace common\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property int $responsible_id
 * @property int $initiator_id
 * @property int $project_id
 * @property string $created_at
 * @property string $updated_at
 *
 * // * @property Chat[] $chats
 * // * @property User $initiator
 * // * @property User $responsible
 * @property Users $user
 */
class Tasks extends \yii\db\ActiveRecord
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
            [['description'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['responsible_id', 'initiator_id', 'project_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
//            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['initiator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['initiator_id' => 'id']],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['responsible_id' => 'id']],
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
            'responsible_id' => 'Responsible ID',
            'initiator_id' => 'Initiator ID',
            'project_id' => 'Project ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getChats()
//    {
//        return $this->hasMany(Chat::className(), ['task_id' => 'id']);
//    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitiator()
    {
        return $this->hasOne(Users::className(), ['id' => 'initiator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
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

    public static function getTaskThisProject()
    {
        $projectId = Yii::$app->request->get('project_id');
        return static::find()
            ->where(['project_id' => $projectId])
            ->all();
    }
}
