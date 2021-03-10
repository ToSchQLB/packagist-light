<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserGitSourceToken;

/**
 * UserGitSourceTokenSearch represents the model behind the search form of `app\models\UserGitSourceToken`.
 */
class UserGitSourceTokenSearch extends UserGitSourceToken
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'git_source_id'], 'integer'],
            [['token'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UserGitSourceToken::find();

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
            'user_id' => Yii::$app->user->id,
            'git_source_id' => $this->git_source_id,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
