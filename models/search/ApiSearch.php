<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Api;

/**
 * ApiSearch represents the model behind the search form about `app\models\Api`.
 */
class ApiSearch extends Api
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_id'], 'integer'],
            [['api_title', 'api_desc', 'api_url', 'api_response'], 'safe'],
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
        $query = Api::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('params');

        $query->andFilterWhere([
            'api_id' => $this->api_id,
            'pro_id' => $params['pro_id']
        ]);

        $query->andFilterWhere(['like', 'api_title', $this->api_title])
            ->andFilterWhere(['like', 'api_desc', $this->api_desc])
            ->andFilterWhere(['like', 'api_url', $this->api_url])
            ->andFilterWhere(['like', 'api_response', $this->api_response]);

        return $dataProvider;
    }
}
