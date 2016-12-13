<?php

    namespace backend\models;

    use Yii;
    use yii\base\Model;

    use app\models\User;

    class UpdateUserForm extends Model
    {
        public $username;
        public $email;
        public $primeiro_nome;
        public $ultimo_nome;
        public $contacto;


        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                // username, name, email, subject and body are required
                [['username', 'email', 'primeiro_nome', 'ultimo_nome', 'contacto'], 'required'],
                // email has to be a valid email address
                ['email', 'email'],
            ];
        }

        public function update()
        {

            $user = User::findOne(4);

            $user->username = $this->username;
            $user->email = $this->email;
            $user->primeiro_nome = $this->primeiro_nome;
            $user->ultimo_nome = $this->ultimo_nome;
            $user->contacto = $this->contacto;

            return $user->update() ? $user : false;

        }

    }
