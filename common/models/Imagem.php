<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property integer $id_imagem
 * @property integer $ce_id_anuncio
 * @property string $caminho
 *
 * @property Anuncio $ceIdAnuncio
 */
class Imagem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ce_id_anuncio'], 'integer'],
            [['caminho'], 'string'],
            [['ce_id_anuncio'], 'exist', 'skipOnError' => true, 'targetClass' => Anuncio::className(), 'targetAttribute' => ['ce_id_anuncio' => 'id_anuncio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_imagem' => 'Id Imagem',
            'ce_id_anuncio' => 'Ce Id Anuncio',
            'caminho' => 'Caminho',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCeIdAnuncio()
    {
        return $this->hasOne(Anuncio::className(), ['id_anuncio' => 'ce_id_anuncio']);
    }
}
