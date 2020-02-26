<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Package;

/**
 * PackageSearch represents the model behind the search form of `app\models\Package`.
 */
class PackageSearch extends Package
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'private'], 'integer'],
            [['name', 'url', 'route', 'repo_user', 'repo_name'], 'safe'],
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
        $query = Package::find();

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
            'private' => $this->private,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'repo_user', $this->repo_user])
            ->andFilterWhere(['like', 'repo_name', $this->repo_name]);

        return $dataProvider;
    }
}
