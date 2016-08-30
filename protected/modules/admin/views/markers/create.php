<?php
/* @var $this MarkersController */
/* @var $model Markers */

$this->breadcrumbs=array(
	'Markers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Markers', 'url'=>array('index')),
	array('label'=>'Manage Markers', 'url'=>array('admin')),
);
?>

<h1>Create Markers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>