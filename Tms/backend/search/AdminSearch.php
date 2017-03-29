<?php

namespace backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdminModel;

/**
 * AdminSearch represents the model behind the search form about `backend\models\AdminModel`.
 */
class AdminSearch extends AdminModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'ausername', 'apassword'], 'safe'],
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
        $query = AdminModel::find();

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
        $query->andFilterWhere(['like', 'aid', $this->aid])
            ->andFilterWhere(['like', 'ausername', $this->ausername])
            ->andFilterWhere(['like', 'apassword', $this->apassword]);

        return $dataProvider;
    }
}
