<?php
/* @var $this ViestintaController */
/* @var $model Viestinta */
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
     <div class="panel-heading">Uusi viesti</div>
     <div class="panel-body">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
  </div>
 </div>
</div>
