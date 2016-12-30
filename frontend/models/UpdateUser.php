<?php
    namespace frontend\models;

    use Yii;
    use yii\base\Model;
    use common\models\User;

    use yii\web\UploadedFile;

    class UpdateUser extends Model
    {
        public $username;
        public $email;
        public $primeiro_nome;
        public $ultimo_nome;
        public $contacto;
        public $imagem;


        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                ['username', 'unique'],
                ['email', 'unique'],
                ['primeiro_nome', 'string', 'min' => 2, 'max' => 255],
                ['ultimo_nome', 'string', 'min' => 2, 'max' => 255],
                ['contacto', 'unique'],
                [['imagem'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ];
        }

        public function updateUser()
        {                                    

            $user = User::findOne(Yii::$app->user->id);            

            $user->username = $this->username;
            $user->email = $this->email;
            $user->primeiro_nome = $this->primeiro_nome;
            $user->ultimo_nome = $this->ultimo_nome;
            $user->contacto = $this->contacto;

            if (isset($this->imagem)) {
                //Guarda na pasta
                $this->imagem->saveAs('../web/css/images/' . $this->imagem->baseName . '.' . $this->imagem->extension);
                //Guarda na BD a imagem
                $img_data = file_get_contents('../web/css/images/' . $this->imagem->baseName . '.' . $this->imagem->extension);
                $base64 = base64_encode($img_data);

                $user->imagem = $base64;
                //-> apaga a imagem da pasta 
                unlink('../web/css/images/' . $this->imagem->baseName . '.' . $this->imagem->extension);
            }         

            return $user->save() ? $user : null;
            
        }
    }
