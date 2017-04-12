<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */

$this->breadcrumbs=array(
	'Asiakkaats'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Asiakkaat', 'url'=>array('index')),
	array('label'=>'Create Asiakkaat', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#asiakkaat-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Asiakkaats</h1>

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
	'id'=>'asiakkaat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'time',
		'yrityksen_nimi',
		'tyyppi',
		'y_tunnus',
		'henkilotunnus',
		/*
		'yhteyshenkilo',
		'sahkoposti',
		'osoite',
		'postinumero',
		'postitoimipaikka',
		'kayntiosoite',
		'kayntipostinumero',
		'kayntipostitoimipaikka',
		'puhelinnumero',
		'laskutuskanava',
		'kirjeluokka',
		'ovt_tunnus',
		'verkkolaskuosoite',
		'valittajatunnus',
		'viivastyskorko',
		'maksuehto',
		'alv_prosentti',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
