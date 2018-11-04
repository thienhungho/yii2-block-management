<?php

namespace thienhungho\Block\modules\BlockManage\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thienhungho\Block\modules\BlockBase\Block;

/**
 * thienhungho\Block\modules\BlockManage\search\BlockSearch represents the model behind the search form about `thienhungho\Block\modules\BlockBase\Block`.
 */
 class BlockSearch extends Block
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author', 'assign_with', 'created_by', 'updated_by'], 'integer'],
            [['name', 'content', 'language', 'created_at', 'updated_at'], 'safe'],
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
        $query = Block::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author' => $this->author,
            'assign_with' => $this->assign_with,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
