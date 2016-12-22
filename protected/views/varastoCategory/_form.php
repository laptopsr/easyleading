<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */
/* @var $form CActiveForm */
$site = Yii::app()->createController('Site');

$malli = $site[0]->malli();

echo '<textarea id="malli" style="display:none">'.$malli.'</textarea>';

$model->ryhmarakenne = json_decode($model->ryhmarakenne);


if (preg_match('/<ul.*>/', $model->ryhmarakenne)) {

	$thisTree = $model->ryhmarakenne;
}else{
	$thisTree = $malli;
}

?>



<!-- Puurakenne -->
	<h2>Uusi puu</h2>
	<span class="btn btn-primary palaaMallin">Palaa mallin</span>



<div class="wrap row">
 <div class="col-sm-8">
    <div class="easy-tree" id="thisTree">
	<?php echo $thisTree; ?>
    </div>
 </div>
</div>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-category-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="form row">
  <div class="col-sm-12">


	<?php echo $form->hiddenField($model,'yid', array('value'=>Yii::app()->getModule('user')->user()->profile->getAttribute('yid'))); ?>
	<?php echo $form->hiddenField($model,'varaston_nimike', array('value'=>$varaston_nimike)); ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textArea($model,'ryhmarakenne',array('rows'=>10, 'cols'=>50, 'class'=>'form-control', 'style'=>'display:none')); ?>


 </div>
</div><!-- form -->


	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submit btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
$(document).ready(function(){


 $('.palaaMallin').click(function(){
	$('#thisTree').html( $('#malli').val() )
 });

 $('.submit').click(function(){

	$('#thisTree').find('.easy-tree-toolbar').remove();


	$('#VarastoCategory_ryhmarakenne').val( $('#thisTree').html() );
	//return false;
	$('#varasto-category-form').submit();
 });

});
</script>
