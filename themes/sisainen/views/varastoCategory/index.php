<?php
/* @var $this VarastoCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Varasto Categories',
);

$this->menu=array(
	array('label'=>'Create VarastoCategory', 'url'=>array('create')),
	array('label'=>'Manage VarastoCategory', 'url'=>array('admin')),
);
?>

<h1>Varasto Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
