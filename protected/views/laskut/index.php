<?php
/* @var $this LaskutController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Laskuts',
);

$this->menu=array(
	array('label'=>'Create Laskut', 'url'=>array('create')),
	array('label'=>'Manage Laskut', 'url'=>array('admin')),
);
?>

<h1>Laskuts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
