<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */

$this->breadcrumbs=array(
	'Varasto Rakennes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VarastoRakenne', 'url'=>array('index')),
	array('label'=>'Create VarastoRakenne', 'url'=>array('create')),
	array('label'=>'Update VarastoRakenne', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VarastoRakenne', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VarastoRakenne', 'url'=>array('admin')),
);
?>

<h1>View VarastoRakenne #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'yid',
		'time',
		'varaston_nimike',
		'sarakkeen_nimi',
		'sarakkeen_tyyppi',
		'sum',
	),
)); ?>
