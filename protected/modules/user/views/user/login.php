<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
/*
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
*/
?>


<div class="container">
    <div class="row">
        <div class="well col-sm-6 col-md-4 col-md-offset-3">
            <h1 class="text-center login-title">Kirjaudu sisään</h1>
            <div class="account-wall">

<div class="form-signin">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username',array('class'=>'form-control')) ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password',array('class'=>'form-control')) ?>
	</div>
	
	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Rekisteröidy"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Unohtuiko salasana?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Kirjaudu"), array('class'=>'btn btn-lg btn-primary btn-block')); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
</div>

            </div>
        </div>
    </div>
</div>

