<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StorehouseModel;

/**
 * StorehouseSearch represents the model behind the search form about `backend\models\StorehouseModel`.
 */
class StorehouseSearch extends StorehouseModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'store_name', 'store_address', 'store_manager'], 'safe'],
            [['store_acre'], 'number'],
            [['store_belong'], 'integer'],
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
        $query = StorehouseModel::find();

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
            'store_acre' => $this->store_acre,
            'store_belong' => $this->store_belong,
        ]);

        $query->andFilterWhere(['like', 'store_id', $this->store_id])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_address', $this->store_address])
            ->andFilterWhere(['like', 'store_manager', $this->store_manager]);

        return $dataProvider;
    }
}
