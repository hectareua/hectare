<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form about `common\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_approved', 'c_rating', 'c_deleted','c_type'], 'integer'],
            [['c_name', 'c_body', 'c_created', 'c_amended'], 'safe'],
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
        $query = Contacts::find();

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
            'c_id' => $this->c_id,
            'c_approved' => $this->c_approved,
            'c_rating' => $this->c_rating,
			'c_type' => $this->c_type,
            'c_created' => $this->c_created,
            'c_amended' => $this->c_amended,
            'c_deleted' => $this->c_deleted,
        ]);

        $query->andFilterWhere(['like', 'c_name', $this->c_name])
            ->andFilterWhere(['like', 'c_body', $this->c_body]);

        return $dataProvider;
    }
}
