<?php 

    namespace frontend\controllers;

    use Yii;
    use yii\web\Controller;

    use yii\helpers\Html;
    use frontend\models\SearchForm;
    use app\models\Distritos;
    use app\models\Concelhos;
    use app\models\Anuncios;

    /**
    * 
    */
    class PesquisaController extends Controller
    {
        /**
         * Procura os concelhos comforme o distrito
         */
        public function actionConcelho($id)
        {

            // -> Busca os concelhos!!
                $n_concelhos = Concelhos::find()
                        ->where(['ce_id_distritos' => $id])
                        ->count();

                $concelhos = Concelhos::find()
                        ->where(['ce_id_distritos' => $id])
                        ->all();

                if ($n_concelhos > 0) {
                    foreach ($concelhos as $concelho) {
                        echo "<option value='".$concelho->id_concelhos."'>".$concelho->nome_concelhos."</option>";
                    }
                }else {
                    echo "<option>--- Seleciona o Concelho ---</option>";
                }

        }

    }

 ?>