<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $role
 *
 * @property Post[] $posts
 */
class Account extends \yii\db\ActiveRecord
{
    public static function primaryKey()
    {
        return ['username'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'role'], 'required'],
            [['username', 'name', 'role'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 250],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['username' => 'username']);
    }


    public function beforeSave($insert) {
        if(isset($this->password)){
            $pass = sha1($this->password);
            $password_hash = password_hash($pass, PASSWORD_DEFAULT);
            $this->password = $password_hash;
        }
        return parent::beforeSave($insert);
    }
}
