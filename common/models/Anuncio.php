<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anuncio".
 *
 * @property integer $id_anuncio
 * @property integer $ce_id_user
 * @property string $asunto
 * @property string $preco
 * @property string $descricao
 * @property integer $id_distrito
 * @property integer $id_concelho
 *
 * @property User $id
 * @property Distritos $idDistrito
 * @property Concelhos $idConcelho
 * @property Imagem[] $imagems
 */
class Anuncio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anuncio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ce_id_user', 'id_distrito', 'id_concelho'], 'integer'],
            [['preco'], 'number'],
            [['descricao'], 'string'],
            [['asunto'], 'string', 'max' => 255],
            [['ce_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ce_id_user' => 'id']],
            [['id_distrito'], 'exist', 'skipOnError' => true, 'targetClass' => Distritos::className(), 'targetAttribute' => ['id_distrito' => 'id_distritos']],
            [['id_concelho'], 'exist', 'skipOnError' => true, 'targetClass' => Concelhos::className(), 'targetAttribute' => ['id_concelho' => 'id_concelhos']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_anuncio' => 'Id Anuncio',
            'ce_id_user' => 'Ce Id User',
            'asunto' => 'Asunto',
            'preco' => 'Preco',
            'descricao' => 'Descricao',
            'id_distrito' => 'Id Distrito',
            'id_concelho' => 'Id Concelho',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCeIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'ce_id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDistrito()
    {
        return $this->hasOne(Distritos::className(), ['id_distritos' => 'id_distrito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConcelho()
    {
        return $this->hasOne(Concelhos::className(), ['id_concelhos' => 'id_concelho']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::className(), ['ce_id_anuncio' => 'id_anuncio']);
    }
}
