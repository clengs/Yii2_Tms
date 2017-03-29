<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AreaModel;

/**
 * AreaSearch represents the model behind the search form about `backend\models\AreaModel`.
 */
class AreaSearch extends AreaModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['childId', 'parentId', 'level'], 'integer'],
            [['childMenu', 'childUrl', 'parentMenu', 'parentUrl'], 'safe'],
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
        $query = AreaModel::find();

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
            'childId' => $this->childId,
            'parentId' => $this->parentId,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'childMenu', $this->childMenu])
            ->andFilterWhere(['like', 'childUrl', $this->childUrl])
            ->andFilterWhere(['like', 'parentMenu', $this->parentMenu])
            ->andFilterWhere(['like', 'parentUrl', $this->parentUrl]);

        return $dataProvider;
    }
}
