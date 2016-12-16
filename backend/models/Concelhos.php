<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "concelhos".
 *
 * @property integer $id_concelhos
 * @property string $nome_concelhos
 * @property integer $ce_id_distritos
 *
 * @property Anuncio[] $anuncios
 * @property Distritos $ceIdDistritos
 */
class Concelhos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'concelhos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ce_id_distritos'], 'integer'],
            [['nome_concelhos'], 'string', 'max' => 20],
            [['ce_id_distritos'], 'exist', 'skipOnError' => true, 'targetClass' => Distritos::className(), 'targetAttribute' => ['ce_id_distritos' => 'id_distritos']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_concelhos' => 'Id Concelhos',
            'nome_concelhos' => 'Nome Concelhos',
            'ce_id_distritos' => 'Ce Id Distritos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncio::className(), ['id_concelho' => 'id_concelhos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCeIdDistritos()
    {
        return $this->hasOne(Distritos::className(), ['id_distritos' => 'ce_id_distritos']);
    }
}
