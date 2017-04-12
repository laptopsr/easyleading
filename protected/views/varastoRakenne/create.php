<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */

$this->breadcrumbs=array(
	'Varasto Rakennes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VarastoRakenne', 'url'=>array('index')),
	array('label'=>'Manage VarastoRakenne', 'url'=>array('admin')),
);
?>

<h1>Create VarastoRakenne</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>