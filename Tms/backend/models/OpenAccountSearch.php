<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OpenAccountModel;

/**
 * OpenAccountSearch represents the model behind the search form about `backend\models\OpenAccountModel`.
 */
class OpenAccountSearch extends OpenAccountModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['terminalId', 'terminalName', 'consumerName', 'consumerAccount', 'consumerPhone', 'consumerAddress', 'time', 'operater'], 'safe'],
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
        $query = OpenAccountModel::find();

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
            'time' => $this->time,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'terminalId', $this->terminalId])
            ->andFilterWhere(['like', 'terminalName', $this->terminalName])
            ->andFilterWhere(['like', 'consumerName', $this->consumerName])
            ->andFilterWhere(['like', 'consumerAccount', $this->consumerAccount])
            ->andFilterWhere(['like', 'consumerPhone', $this->consumerPhone])
            ->andFilterWhere(['like', 'consumerAddress', $this->consumerAddress])
            ->andFilterWhere(['like', 'operater', $this->operater]);

        return $dataProvider;
    }
}
