<?php
/* @var $this TuotantoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tuotantos',
);

$this->menu=array(
	array('label'=>'Create Tuotanto', 'url'=>array('create')),
	array('label'=>'Manage Tuotanto', 'url'=>array('admin')),
);
?>

<h1>Tuotantos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
