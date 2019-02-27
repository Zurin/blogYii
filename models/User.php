<?php

namespace app\models;

use app\models\Account;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $username;
    public $password;
    public $name;
    // public $accessToken;
    public $role;

    /**
     * {@inheritdoc}
     */

    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        // $user = Account::findOne($id); 
        // if(count($user) > 0){
        //     return new static($user);
        // }
        // return null;
        $user = Account::find()->where(['username'=>$id])->one(); 
        if($user){
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // foreach (self::$users as $user) {
        //     if ($user['accessToken'] === $token) {
        //         return new static($user);
        //     }
        // }

        // return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //mencari user login berdasarkan username dan hanya dicari 1.
        $user = Account::find()->where(['username'=>$username])->one(); 
        if($user){
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;
        if(password_verify(sha1($password), $this->password)){
            return true;
        } else {
            return false;
        }
    }
}
