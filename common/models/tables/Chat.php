<?php

namespace common\models\tables;

use common\models\User;
use Yii;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;


//require(__DIR__ . '../../../vendor/yiisoft/yii2/Yii.php');

//require __DIR__ . '/../../../vendor/autoload.php';
//require __DIR__ . '/../../../vendor/yiisoft/yii2/Yii.php';
//require __DIR__ . '/../../../common/config/bootstrap.php';
//require __DIR__ . '/../../config/bootstrap.php';

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $message
 *
 * @property Tasks $task
 * @property User $user
 */
class Chat extends \yii\db\ActiveRecord implements MessageComponentInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id'], 'integer'],
            [['message'], 'string', 'max' => 1024],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    protected $clients;
    protected $user;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }


    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }


    function onMessage(ConnectionInterface $from, $msg)
    {
//        $user = Yii::$app->user->identity->username;

//        $test = Yii::$app->session['__id'];
//
//        echo "message {$msg} from {$test} \n";
//        Chat::addChat($msg);

        echo "message {$msg} from {$from->resourceId} \n";


        foreach ($this->clients as $client) {
            $client->send($msg);

        }
    }


    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect \n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
        echo "conn {$conn->resourceId} closed with error \n";
    }



    public static function addChat() {

//var_dump(Yii::$app->session['__id']);

//        $chat = new Chat();
//        $chat->user_id = Yii::$app->session['__id'];
//        $chat->task_id = 1;
//        $chat->message = $message;
//        $chat->save();
    }


}
