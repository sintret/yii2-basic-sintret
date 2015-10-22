<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MySession;

/**
 * MySessionSearch represents the model behind the search form about `app\models\MySession`.
 */
class MySessionSearch extends MySession
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'data'], 'safe'],
            [['expire'], 'integer'],
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
        $query = MySession::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'expire' => $this->expire,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
