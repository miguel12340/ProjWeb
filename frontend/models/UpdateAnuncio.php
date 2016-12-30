<?php 

	namespace frontend\models;

	use yii;
	use yii\base\Model;
	use common\models\Anuncio;
	use common\models\User;

	use yii\web\UploadedFile;

	/**
	* 
	*/
	class UpdateAnuncio extends Model
	{
		// --> Campos principais do anuncio
			public $id_anuncio;
			public $asunto;
			public $n_pessoas;
			public $descricao;
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

				[['id_anuncio', 'asunto', 'n_pessoas', 'preco', 'descricao'], 'required'],

				[['distritos', 'concelhos'], 'required'],

				[['imagens'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],

			];
		}

		public function updateAnuncio()
		{
			$anuncio = Anuncio::findOne($this->id_anuncio);
			$anuncio->asunto = $this->asunto;
			$anuncio->n_pessoas = $this->n_pessoas;
			$anuncio->preco = $this->preco;
			$anuncio->descricao = $this->descricao;
			$anuncio->id_distrito = $this->distritos;
			$anuncio->id_concelho = $this->concelhos;

			if ($this->imagens != null) {
				$anuncio->imagem0 = '';
				$anuncio->imagem1 = '';
				$anuncio->imagem2 = '';
				$anuncio->imagem3 = '';
				$data = array();
				foreach ($this->imagens as $key => $imagem) {
					$imagem->saveAs('../web/css/images/' . $imagem->baseName . '.' . $imagem->extension);

					$img_data = file_get_contents('../web/css/images/' . $imagem->baseName . '.' . $imagem->extension);
					$data = base64_encode($img_data);

					$property = 'imagem' . $key;
					$anuncio->$property = $data;
					unlink('../web/css/images/' . $imagem->baseName . '.' . $imagem->extension);
				}

			}

			return $anuncio->save() ? $anuncio : null;

		}

	}












 ?>