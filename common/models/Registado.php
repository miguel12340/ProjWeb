<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "registado".
 *
 * @property integer $id_registado
 * @property integer $ce_id_utilizador
 *
 * @property Anuncio[] $anuncios
 * @property User $ceIdUtilizador
 */
class Registado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ce_id_utilizador'], 'integer'],
            [['ce_id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ce_id_utilizador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_registado' => 'Id Registado',
            'ce_id_utilizador' => 'Ce Id Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncio::className(), ['ce_id_registado' => 'id_registado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCeIdUtilizador()
    {
        return $this->hasOne(User::className(), ['id' => 'ce_id_utilizador']);
    }
}
