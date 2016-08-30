<?php var_dump($model) ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'serial-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'address',
		'genre',
		'lat',
		'lng',
		'type',
		/*
		'img',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>