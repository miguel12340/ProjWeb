<?php

    namespace frontend\models;

    use Yii;
    use yii\base\Model;
    use common\models\Anuncio;
    use common\models\User;

    use yii\web\UploadedFile;

    class CreateAnuncio extends Model
    {
        // --> Campos principais do anuncio
            public $asunto;
            public $n_pessoas;
            public $descricao;
            public $cordenadas;
            public $preco;
            // --> passa os id's do distrito e concelho
                public $distritos;
                public $concelhos;
        // --> Imagens do anuncio
        public $imagens;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [

                [['asunto', 'n_pessoas', 'preco', 'descricao'], 'required'],
                ['cordenadas', 'string', 'min' => 2, 'max' => 255],

                [['distritos', 'concelhos'], 'required'],

                [['imagens'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],

            ];
        }

        public function createAnuncio()
        {            
            $anuncio = new Anuncio();
            $anuncio->ce_id_user = Yii::$app->user->id;
            $anuncio->asunto = $this->asunto;
            $anuncio->n_pessoas = $this->n_pessoas;
            $anuncio->descricao = $this->descricao;
            $anuncio->cordenadas = $this->cordenadas;
            $anuncio->preco = $this->preco;
            $anuncio->status = 'not suspended';
            $anuncio->id_distrito = $this->distritos;
            $anuncio->id_concelho = $this->concelhos;

            if (!$this->imagens) {
                //Guarda na BD a imagem default
                $img_data = file_get_contents('../web/images/Imagem-Default.jpg');
                $base64 = base64_encode($img_data);

                $anuncio->imagem0 = $base64;

            }else {
                $data = array();
                foreach ($this->imagens as $key => $imagem) {
                    $imagem->saveAs('../web/images/' . $imagem->baseName . '.' . $imagem->extension);

                    $img_data = file_get_contents('../web/images/' . $imagem->baseName . '.' . $imagem->extension);
                    $data = base64_encode($img_data);

                    $property = 'imagem' . $key;
                    $anuncio->$property = $data;
                    unlink('../web/images/' . $imagem->baseName . '.' . $imagem->extension);
                }

            }
            
            return $anuncio->save() ? $anuncio : null;
        }
    }
