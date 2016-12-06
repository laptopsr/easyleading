<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */
/* @var $form CActiveForm */

	if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid'))
	$model->yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

	$criteria = new CDbCriteria;
	$criteria->order = " id DESC ";
	$criteria->group = " varaston_nimike ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND value=''
	";
	$varastot = VarastoRakenne::model()->findAll($criteria);

?>

	<p class="note"><?php echo Yii::t('main', 'Tähdellä<span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>

<div class="form row">
  <div class="col-sm-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-rakenne-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'yid'); ?>
	<?php echo $form->hiddenField($model,'is_otsikko', array('value'=>1)); ?>

	<?php if(count($varastot) > 0): ?>
	<div class="row">
		<label><?php echo Yii::t('main', 'Olevat varastot'); ?></label>
		<?php
        	echo CHtml::dropDownList('olemassa', 'varaston_olemassa', CHtml::listData(VarastoRakenne::model()->findAll($criteria), 'varaston_nimike', 'varaston_nimike'),
		array('empty'=>Yii::t('main', 'Valitse varasto'),'class'=>'form-control'));	
        	?>
	</div>
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'varaston_nimike'); ?>
		<?php echo $form->textField($model,'varaston_nimike',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'varaston_nimike'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sarakkeen_nimi'); ?>
		<?php echo $form->textField($model,'sarakkeen_nimi',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sarakkeen_nimi'); ?>
	</div>
  </div>
  <div class="col-sm-4">

	<div class="row">
		<?php echo $form->labelEx($model,'sarakkeen_tyyppi'); ?>
		<?php
		$list = array(1=>Yii::t('main', 'Tekstinä'), 2=>Yii::t('main', 'Numerona'));
        	echo $form->dropDownList($model, 'sarakkeen_tyyppi', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'sarakkeen_tyyppi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sum'); ?>
		<?php
		$list = array(0=>Yii::t('main', 'Ei lasketa yhteensä'), 1=>Yii::t('main', 'Lasketaan yhteensä'));
        	echo $form->dropDownList($model, 'sum', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'sum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->numberField($model,'position',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
 </div>
</div><!-- form -->

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submit btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
$(document).ready(function(){

$('#olemassa').change(function(){
	var thisVal = $('#olemassa option:selected').text();
	$('#VarastoRakenne_varaston_nimike').attr('readonly','yes').val(thisVal);
});


});
</script>


