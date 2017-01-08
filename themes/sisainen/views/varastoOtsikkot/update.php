<?php
/* @var $this VarastoOtsikkotController */
/* @var $model VarastoOtsikkot */

$this->breadcrumbs=array(
	'Varasto Otsikkots'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VarastoOtsikkot', 'url'=>array('index')),
	array('label'=>'Create VarastoOtsikkot', 'url'=>array('create')),
	array('label'=>'View VarastoOtsikkot', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VarastoOtsikkot', 'url'=>array('admin')),
);
?>

<h1>Update VarastoOtsikkot <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>