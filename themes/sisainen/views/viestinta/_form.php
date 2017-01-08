<?php
/* @var $this ViestintaController */
/* @var $model Viestinta */
/* @var $form CActiveForm */

if(isset($_GET['saaja']))
$model->saaja = $_GET['saaja'];

$model->lahettaja = Yii::app()->user->id;

?>

<div class="form row">
  <div class="col-sm-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viestinta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main', 'Tähdellä<span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->hiddenField($model,'lahettaja'); ?>

	<div class="">
		<?php echo $form->labelEx($model,'saaja'); ?>
		<?php 
		$site = Yii::app()->createController('Site');
		$list = $site[0]->yidArrayList(null, null);

        	  echo $form->dropDownList($model, 'saaja', $list,
			array('class'=>'form-control'));
		?>
		<?php echo $form->error($model,'saaja'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'otsikko'); ?>
		<?php echo $form->textField($model,'otsikko',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'otsikko'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'teksti'); ?>
		<?php echo $form->textArea($model,'teksti',array('s'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'teksti'); ?>
	</div>

	<br>

	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Lähetä' : 'Lähetä', array('class'=>'submit btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->
