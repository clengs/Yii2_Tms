<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MessageModel;

/**
 * MessageSearch represents the model behind the search form about `backend\models\MessageModel`.
 */
class MessageSearch extends MessageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msgId', 'senderID', 'senderName', 'recipientID', 'recipientName', 'title', 'content', 'sendtime'], 'safe'],
            [['state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MessageModel::find();

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
            'sendtime' => $this->sendtime,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'msgId', $this->msgId])
            ->andFilterWhere(['like', 'senderID', $this->senderID])
            ->andFilterWhere(['like', 'senderName', $this->senderName])
            ->andFilterWhere(['like', 'recipientID', $this->recipientID])
            ->andFilterWhere(['like', 'recipientName', $this->recipientName])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
