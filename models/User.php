<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package app\models
 *
 * @property UserGitSourceToken[] $gitSourceTokens
 */
class User extends \Da\User\Model\User
{

    /**
     * @return ActiveQuery
     */
    public function getGitSourceTokens()
    {
        return $this->hasMany(
            UserGitSourceToken::class,
            ['user_id' => 'id']
        );
    }

    public static function all()
    {
        return ArrayHelper::map(User::find()->all(), 'id', 'username');
    }
}
