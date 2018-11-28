<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\tables\Chat;

/**
 * ChatSearch represents the model behind the search form of `common\models\tables\Chat`.
 */
class ChatSearch extends Chat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'task_id'], 'integer'],
            [['message'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Chat::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
