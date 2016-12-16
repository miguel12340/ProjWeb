<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Concelhos;

/**
 * ConcelhoSearch represents the model behind the search form about `app\models\Concelhos`.
 */
class ConcelhoSearch extends Concelhos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_concelhos', 'ce_id_distritos'], 'integer'],
            [['nome_concelhos'], 'safe'],
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
        $query = Concelhos::find();

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
            'id_concelhos' => $this->id_concelhos,
            'ce_id_distritos' => $this->ce_id_distritos,
        ]);

        $query->andFilterWhere(['like', 'nome_concelhos', $this->nome_concelhos]);

        return $dataProvider;
    }
}
