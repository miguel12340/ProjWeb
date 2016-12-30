<?php 

	namespace frontend\controllers;

	use Yii;
	use yii\web\Controller;

	use yii\helpers\Html;

	use app\models\Anuncio;

	/**
	* 
	*/
	class AnuncioController extends Controller
	{
		/**
		 * Suspender Anuncio
		 */
		public function actionSuspender($id_anuncio)
		{
			
			// -> Busca o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			// -> Altera o campo satus para - suspended
				$anuncio->status = 'suspended';

			if ($anuncio->save()) {
				Yii::$app->session->setFlash('success', 'O Anuncio foi suspendido!!');
				return $this->redirect('index.php?r=site/index');
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect('index.php?r=site/index');
			}

		}
		/**
		 * Ativar Anuncio
		 */
		public function actionAtivar($id_anuncio)
		{
			
			// -> Busca o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			// -> Altera o campo satus para - suspended
				$anuncio->status = 'not suspended';

			if ($anuncio->save()) {
				Yii::$app->session->setFlash('success', 'O Anuncio foi Ativado!!');
				return $this->redirect('index.php?r=site/index');
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect('index.php?r=site/index');
			}

		}
		/**
		 * Eliminar Anuncio
		 */
		public function actionEliminar($id_anuncio)
		{
			
			// -> Elimina o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			if ($anuncio->delete()) {
				Yii::$app->session->setFlash('success', 'O Anuncio foi Eliminado!!');
				return $this->redirect('index.php?r=site/index');
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect('index.php?r=site/index');
			}

		}

	}


 ?>