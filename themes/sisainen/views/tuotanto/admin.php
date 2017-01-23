<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */

$this->breadcrumbs=array(
	'Tuotantos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tuotanto', 'url'=>array('index')),
	array('label'=>'Create Tuotanto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tuotanto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tuotantos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tuotanto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'time',
		'tehtavanimike',
		'osoitettu_tyontekija',
		'tyon_tiedot',
		'suunniteltu_aloitus',
		/*
		'suuniteltu_lopetus',
		'toteutunut_aloitus',
		'toteutunut_lopetus',
		'lisatiedot',
		'liitteet',
		'varasto_tuote',
		'extra_sarake1',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
