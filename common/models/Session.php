<?php

namespace common\models;

use yii\db\ActiveRecord;
//-
use common\models\User;
//-
/* This is the model class for table "session".
 *
 * @property integer $id
* @property string $accessToken
* @property string $creationDate
* @property integer $valid
* @property integer $userId
*
 * @property User $user
*/
class Session extends ActiveRecord
{
/* @inheritdoc
*/
    public static function tableName()
    {
        return 'session';
    }

/* @return \yii\db\ActiveQuery
*/
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

/* @inheritdoc
*/
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->creationDate = date('Y-m-d H:i:s');
                $this->valid = 1;
            }
            return true;
        }
        return false;
    }
}