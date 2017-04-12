<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */

$this->breadcrumbs=array(
	'Varasto Rakennes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VarastoRakenne', 'url'=>array('index')),
	array('label'=>'Create VarastoRakenne', 'url'=>array('create')),
	array('label'=>'View VarastoRakenne', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VarastoRakenne', 'url'=>array('admin')),
);
?>

<h1>Update VarastoRakenne <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>