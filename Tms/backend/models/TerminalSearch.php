<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TerminalModel;

/**
 * TerminalSearch represents the model behind the search form about `backend\models\TerminalModel`.
 */
class TerminalSearch extends TerminalModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serialId', 'storeId', 'name', 'model', 'verder', 'inboundTime', 'manufacturer', 'produceTime', 'operater'], 'safe'],
            [['quantity'], 'integer'],
            [['price'], 'number'],
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
        $query = TerminalModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'quantity' => $this->quantity,
            'price' => $this->price,
            'inboundTime' => $this->inboundTime,
            'produceTime' => $this->produceTime,
        ]);

        $query->andFilterWhere(['like', 'serialId', $this->serialId])
            ->andFilterWhere(['like', 'storeId', $this->storeId])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'verder', $this->verder])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'operater', $this->operater]);

        return $dataProvider;
    }
}
