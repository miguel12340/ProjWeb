<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distritos".
 *
 * @property integer $id_distritos
 * @property string $nome_distritos
 *
 * @property Anuncio[] $anuncios
 * @property Concelhos[] $concelhos
 */
class Distritos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distritos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome_distritos'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_distritos' => 'Id Distritos',
            'nome_distritos' => 'Nome Distritos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncio::className(), ['id_distrito' => 'id_distritos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcelhos()
    {
        return $this->hasMany(Concelhos::className(), ['ce_id_distritos' => 'id_distritos']);
    }
}
