<?php
/* @var $this YiichatPostController */
/* @var $model YiichatPost */

$this->breadcrumbs=array(
	'Yiichat Posts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List YiichatPost', 'url'=>array('index')),
	array('label'=>'Create YiichatPost', 'url'=>array('create')),
	array('label'=>'Update YiichatPost', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete YiichatPost', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YiichatPost', 'url'=>array('admin')),
);
?>

<h1>View YiichatPost #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'chat_id',
		'post_identity',
		'owner',
		'created',
		'text',
		'data',
	),
)); ?>
