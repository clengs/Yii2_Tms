<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuditingModel;

/**
 * AuditingSearch represents the model behind the search form about `backend\models\AuditingModel`.
 */
class AuditingSearch extends AuditingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'terminals'], 'integer'],
            [['title', 'proposer', 'proposer_phone', 'proposer_email', 'proposer_contry', 'require_belongto', 'time', 'description', 'comments', 'file', 'aprove_record', 'aprover', 'aprover_phone', 'aprover_email', 'approver_idea', 'next_approver','have_finish', 'remain_str'], 'safe'],
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
        $query = AuditingModel::find();

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
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'aprove_record', $this->aprove_record])
            ->andFilterWhere(['like', 'aprover', $this->aprover])
            ->andFilterWhere(['like', 'aprover_phone', $this->aprover_phone])
            ->andFilterWhere(['like', 'aprover_email', $this->aprover_email])
            ->andFilterWhere(['like', 'approver_idea', $this->approver_idea])
            ->andFilterWhere(['like', 'next_approver', $this->next_approver])
            ->andFilterWhere(['like', 'have_finish', $this->have_finish])
            ->andFilterWhere(['like', 'remain_str', $this->remain_str]);

        return $dataProvider;
    }
}
