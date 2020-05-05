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
    public $git_source;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'git_source_id', 'private'], 'integer'],
            [['name', 'repo_user', 'repo_name','git_source'], 'safe'],
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
            'git_source_id' => $this->git_source,
            // 'git_source_id' => $this->git_source,
            'private' => $this->private,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'repo_user', $this->repo_user])
            ->andFilterWhere(['like', 'git_source_id', $this->git_source])
            ->andFilterWhere(['like', 'repo_name', $this->repo_name]);


        return $dataProvider;
    }
}
