<?php
/* @var $this ViestintaController */
/* @var $model Viestinta */
/* @var $form CActiveForm */

if(isset($_GET['saaja']))
$model->saaja = $_GET['saaja'];

$model->lahettaja = Yii::app()->user->id;

if(isset($_GET['vastaus_id']))
{
	$vanhaViesti = Viestinta::model()->findByPk($_GET['vastaus_id']);
	if(isset($vanhaViesti->teksti))
	{
		$us = Profile::model()->findByPk(Yii::app()->user->id);
		$ul = Profile::model()->findByPk($vanhaViesti->lahettaja);

		$model->saaja = $vanhaViesti->lahettaja;
		$model->otsikko = $vanhaViesti->otsikko;

		$m = "RE: \n";
		$m .= $ul->firstname.' '.$ul->lastname.': '.$vanhaViesti->teksti;
		$m .= "\n --------- \n";
		$m .= $us->firstname.' '.$us->lastname.': ';
		$model->teksti = $m;

	echo '
	<script>
	$(function() {

		$("#Viestinta_teksti").focus();
	});
	</script>
	';
	}
}
?>

<div class="form row">
  <div class="col-sm-6">
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
		<?php echo $form->textArea($model,'teksti',array('rows'=>6, 'cols'=>50, 'class'=>'form-control','onfocus'=>"var val=this.value; this.value=''; this.value= val;")); ?>
		<?php echo $form->error($model,'teksti'); ?>
	</div>

	<br>

	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Lähetä' : 'Lähetä', array('class'=>'submit btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->
