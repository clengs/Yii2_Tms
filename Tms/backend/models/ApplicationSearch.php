<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ApplicationModel;

/**
 * ApplicationSearch represents the model behind the search form about `backend\models\ApplicationModel`.
 */
class ApplicationSearch extends ApplicationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'terminals'], 'integer'],
            [['title', 'proposer', 'proposer_phone', 'proposer_email', 'proposer_contry', 'require_belongto', 'aprover', 'time', 'description', 'comments', 'file', 'aprove_record'], 'safe'],
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
        $query = ApplicationModel::find();

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
            'terminals' => $this->terminals,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'proposer', $this->proposer])
            ->andFilterWhere(['like', 'proposer_phone', $this->proposer_phone])
            ->andFilterWhere(['like', 'proposer_email', $this->proposer_email])
            ->andFilterWhere(['like', 'proposer_contry', $this->proposer_contry])
            ->andFilterWhere(['like', 'require_belongto', $this->require_belongto])
            ->andFilterWhere(['like', 'aprover', $this->aprover])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'aprove_record', $this->aprove_record]);

        return $dataProvider;
    }
}
