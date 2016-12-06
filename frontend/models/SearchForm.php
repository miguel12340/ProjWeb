<?php 

	namespace frontend\models;

	use Yii;
	use yii\base\Model;

	/**
	* SearchForm class
	*/
	class SearchForm extends Model
	{

	    public $distritos;
	    public $concelhos;


	    /**
	     * @inheritdoc
	     */
	    public function rules()
	    {
	        return [
	            // distritos, concelhos are required
	            [['distritos', 'concelhos'], 'required'],
	        ];
	    }

	}


 ?>