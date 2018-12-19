<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 *
 * @property Tasks[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 128],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id']);
    }

    public static function getTask($id)
    {
        return static::find()
            ->where(['id' => $id])
            ->all();
    }

}
