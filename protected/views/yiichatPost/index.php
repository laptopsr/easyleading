<?php
/* @var $this YiichatPostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Yiichat Posts',
);

$this->menu=array(
	array('label'=>'Create YiichatPost', 'url'=>array('create')),
	array('label'=>'Manage YiichatPost', 'url'=>array('admin')),
);
?>

<h1>Yiichat Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
