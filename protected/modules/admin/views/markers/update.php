<?php
/* @var $this MarkersController */
/* @var $model Markers */

$this->breadcrumbs=array(
	'Markers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Markers', 'url'=>array('index')),
	array('label'=>'Create Markers', 'url'=>array('create')),
	array('label'=>'View Markers', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Markers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>