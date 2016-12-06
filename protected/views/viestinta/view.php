<?php
/* @var $this ViestintaController */
/* @var $model Viestinta */
Viestinta::model()->updatebypk($model->id, array('is_katsonut'=>1));
?>

<!--Back-->
<p>
	<?php echo CHtml::link('<i class="fa fa-backward" aria-hidden="true"></i>',Yii::app()->request->urlReferrer, 
		array(
			'class'=>'btn btn-default', 
			'data-toggle'=>'tooltip', 
			'data-placement'=>'top', 
			'title'=>Yii::t('main', 'Takaisin')
		)); 
	?>
</p>
<!--Back-->

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading">Viesti #<?php echo $model->id; ?></div>
     <div class="panel-body">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'time',
		'saaja',
		'lahettaja',
		'teksti',
	),
)); ?>


    </div>
  </div>
 </div>
</div>
