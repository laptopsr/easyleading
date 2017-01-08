<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */

$this->breadcrumbs=array(
	'Varasto Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VarastoCategory', 'url'=>array('index')),
	array('label'=>'Manage VarastoCategory', 'url'=>array('admin')),
);
?>

<h1>Create VarastoCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>