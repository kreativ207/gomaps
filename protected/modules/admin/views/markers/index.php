<?php
/* @var $this MarkersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Markers',
);

$this->menu=array(
	array('label'=>'Создать маркер', 'url'=>array('create')),
);
?>

<h1>Markers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'address',
		'lat',
		'lng',
		//'type',
		/*
		'img',
		*/
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
            'delete' => array(
                //'visible' => 'здесь пропишите условие',
                )
            ),
        ),
    /*array(
        'class'=>'CButtonColumn',
    ),*/
	),
)); ?>
