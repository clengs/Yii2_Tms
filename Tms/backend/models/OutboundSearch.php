<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OutboundModel;

/**
 * OutboundSearch represents the model behind the search form about `backend\models\OutboundModel`.
 */
class OutboundSearch extends OutboundModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['terminalId', 'storehouseId', 'adminId', 'outboundTime'], 'safe'],
            [['outboundQuantity', 'destinationId', 'receiverId'], 'integer'],
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
        $query = OutboundModel::find();

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
            'outboundTime' => $this->outboundTime,
            'outboundQuantity' => $this->outboundQuantity,
            'destinationId' => $this->destinationId,
            'receiverId' => $this->receiverId,
        ]);

        $query->andFilterWhere(['like', 'terminalId', $this->terminalId])
            ->andFilterWhere(['like', 'storehouseId', $this->storehouseId])
            ->andFilterWhere(['like', 'adminId', $this->adminId]);

        return $dataProvider;
    }
}
