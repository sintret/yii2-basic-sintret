<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Setting;

/**
 * SettingSearch represents the model behind the search form about `app\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sms', 'gcm', 'userCreate', 'userUpdate'], 'integer'],
            [['applicationName', 'description', 'sms_key', 'sms_pass', 'gcm_api_key', 'gcm_sender', 'emailAdmin', 'emailSupport', 'emailOrder', 'sendgridUsername', 'sendgridPassword', 'whatsappNumber', 'whatsappPassword', 'whatsappSend', 'facebook', 'instagram', 'google', 'twitter', 'updateDate', 'createDate'], 'safe'],
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
        $query = Setting::find();

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
            'sms' => $this->sms,
            'gcm' => $this->gcm,
            'userCreate' => $this->userCreate,
            'userUpdate' => $this->userUpdate,
            'updateDate' => $this->updateDate,
            'createDate' => $this->createDate,
        ]);

        $query->andFilterWhere(['like', 'applicationName', $this->applicationName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sms_key', $this->sms_key])
            ->andFilterWhere(['like', 'sms_pass', $this->sms_pass])
            ->andFilterWhere(['like', 'gcm_api_key', $this->gcm_api_key])
            ->andFilterWhere(['like', 'gcm_sender', $this->gcm_sender])
            ->andFilterWhere(['like', 'emailAdmin', $this->emailAdmin])
            ->andFilterWhere(['like', 'emailSupport', $this->emailSupport])
            ->andFilterWhere(['like', 'emailOrder', $this->emailOrder])
            ->andFilterWhere(['like', 'sendgridUsername', $this->sendgridUsername])
            ->andFilterWhere(['like', 'sendgridPassword', $this->sendgridPassword])
            ->andFilterWhere(['like', 'whatsappNumber', $this->whatsappNumber])
            ->andFilterWhere(['like', 'whatsappPassword', $this->whatsappPassword])
            ->andFilterWhere(['like', 'whatsappSend', $this->whatsappSend])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'google', $this->google])
            ->andFilterWhere(['like', 'twitter', $this->twitter]);

        return $dataProvider;
    }
}
