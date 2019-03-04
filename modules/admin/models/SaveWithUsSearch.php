<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaveWithUs;

/**
 * SaveWithUsSearch represents the model behind the search form about `app\models\SaveWithUs`.
 */
class SaveWithUsSearch extends SaveWithUs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id'], 'integer'],
            [['name_uk', 'name_ru', 'text_uk', 'text_ru'], 'safe'],
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
        $query = SaveWithUs::find();

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
            'image_id' => $this->image_id,
        ]);

        $query->andFilterWhere(['like', 'name_uk', $this->name_uk])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'text_uk', $this->text_uk])
            ->andFilterWhere(['like', 'text_ru', $this->text_ru]);

        return $dataProvider;
    }
}
