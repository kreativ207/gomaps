<?php

class GoogleController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionMaps(){

		$this->layout = false;	
		$connection = Yii::app()->db;
        $markers = "SELECT * FROM markers ORDER BY id DESC";
        $command = $connection->createCommand($markers);
        $data = $command->queryAll();

		return $this->render('views',['data' => $data]);
	}

	public function actionGm(){


		$connection = Yii::app()->db;
        $markers = "SELECT * FROM markers ORDER BY id DESC";
        $command = $connection->createCommand($markers);
        $links = $command->queryAll();
		//$this->layout = false;
		return $this->render('gm', ['links' => $links]);
	}
}
