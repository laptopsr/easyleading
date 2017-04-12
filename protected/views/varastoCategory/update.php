<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */

$this->breadcrumbs=array(
	'Varasto Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VarastoCategory', 'url'=>array('index')),
	array('label'=>'Create VarastoCategory', 'url'=>array('create')),
	array('label'=>'View VarastoCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VarastoCategory', 'url'=>array('admin')),
);
?>

<h1>Update VarastoCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>