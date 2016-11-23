<div class="row">
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);

$sahkoposti = '';
if(isset(Yii::app()->user->sahkoposti))
$sahkoposti = Yii::app()->user->sahkoposti;
?>

<h1><?php echo UserModule::t("Rekisteröinti"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<?php if(isset(Yii::app()->user->kayttokoodi)): ?>
<div class="alert alert-danger">
Huom!!! Saat käyttökoodi toimimaan vain rekisterönnin jälkeen.
Käyttökoodi on <b><?php echo Yii::app()->user->kayttokoodi; ?></b>
</div>
<?php endif; ?>


<p><?php echo CHtml::link('Olen jo rekisteröinyt', Yii::app()->request->baseUrl.'/index.php/user/login',array('class'=>'btn btn-primary')); ?></p>
<br>
</div>


<div class="row form">
  <div class="col-sm-4 well">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Tähdellä <span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Salasanassa pitää olla vähintään 4 merkkiä."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email',array('value'=>$sahkoposti,'class'=>'form-control')); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
	
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control'));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control'));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Kirjoita kuvassa näkyva koodi alla olevaan kenttään."); ?>
		</p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Rekisteröidy"),array('class'=>'btn btn-primary')); ?>
	</div>



<?php $this->endWidget(); ?>
  </div>
</div><!-- form -->

<center>
  <img src="https://img.paytrail.com/index.svm?id=13466&type=horizontal&cols=15&text=1&auth=f6483cce23771e8f" class="img-thumbnail">
</center>
<br>
<?php endif; ?>
