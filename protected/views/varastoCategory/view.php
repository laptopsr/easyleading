<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */

$this->breadcrumbs=array(
	'Varasto Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VarastoCategory', 'url'=>array('index')),
	array('label'=>'Create VarastoCategory', 'url'=>array('create')),
	array('label'=>'Update VarastoCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VarastoCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VarastoCategory', 'url'=>array('admin')),
);
?>

<h1>View VarastoCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'yid',
		'ryhmarakenne',
		'varaston_nimike',
	),
)); ?>
