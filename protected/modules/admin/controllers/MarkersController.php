<?php

class MarkersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		 return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','create', 'update', 'delete', 'test'),
                'roles'=>array('2'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/jquery.geocomplete.js');
        $model=new Markers;

        if(isset($_POST['Markers']))
        {
            $model->address = $_POST['geocomplete'];
            $model->lat = $_POST['lat'];
            $model->lng = $_POST['lng'];
            $model->attributes=$_POST['Markers'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('main_loc',array(
            'model'=>$model,
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/jquery.geocomplete.js');
        $model=$this->loadModel($id);

        if(isset($_POST['Markers']))
        {
            $model->address = $_POST['geocomplete'];
            $model->lat = $_POST['lat'];
            $model->lng = $_POST['lng'];
            $model->attributes=$_POST['Markers'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('main_loc',array(
            'model'=>$model,
        ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Markers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$model=new Markers('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Markers']))
			$model->attributes=$_GET['Markers'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Markers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Markers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Markers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='markers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
