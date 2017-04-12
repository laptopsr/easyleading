<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tuotanto-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Tähdellä <span class="required">*</span> merkityt kentät ovat pakollisia.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row form">
 <div class="col-sm-6">


	<div class="">
		<?php echo $form->labelEx($model,'tehtavanimike'); ?>
		<?php echo $form->textField($model,'tehtavanimike',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tehtavanimike'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'osoitettu_tyontekija'); ?>
		<?php 
		$criteria = new CDbcriteria;
		$criteria->condition = "
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
			AND tyyppi=2
		";
		$profile = Profile::model()->findAll($criteria);
		$list = array();
		foreach($profile as $item)
		$list[$item->user_id] = $item->firstname.' '.$item->lastname;
        	echo $form->dropDownList($model, 'osoitettu_tyontekija', $list,
		array('empty'=>Yii::t('main', 'Valitse työntekijä'),'class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'osoitettu_tyontekija'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'tyon_tiedot'); ?>
		<?php echo $form->textArea($model,'tyon_tiedot',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tyon_tiedot'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'suunniteltu_aloitus'); ?>
		<?php echo $form->textField($model,'suunniteltu_aloitus',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'suunniteltu_aloitus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'suuniteltu_lopetus'); ?>
		<?php echo $form->textField($model,'suuniteltu_lopetus',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'suuniteltu_lopetus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'toteutunut_aloitus'); ?>
		<?php echo $form->textField($model,'toteutunut_aloitus',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'toteutunut_aloitus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'toteutunut_lopetus'); ?>
		<?php echo $form->textField($model,'toteutunut_lopetus',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'toteutunut_lopetus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'lisatiedot'); ?>
		<?php echo $form->textArea($model,'lisatiedot',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'lisatiedot'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'liitteet'); ?>
		<?php echo $form->fileField($model,'liitteet[]', array('class'=>'form-control', 'multiple'=>'yes')); ?>
		<?php echo $form->error($model,'liitteet'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'varasto_tuote'); ?>
		<?php echo $form->textField($model,'varasto_tuote', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'varasto_tuote'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'extra_sarake1'); ?>
		<?php echo $form->textField($model,'extra_sarake1',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'extra_sarake1'); ?>
	</div>


 </div>
</div><!-- form -->

	<br>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Valmis' : 'Tallenna', array('class' => 'btn btn-default btn-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
