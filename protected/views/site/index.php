<?php
/* @var $this SiteController */
?>
<div id="etusivu">

<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') != 2) : ?>

	<div class="row">
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php if(Yii::app()->user->isAdmin()) : ?>
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user/admin',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	  <?php else: ?>
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	  <?php endif; ?>
	 </div>
	 <!--laatiko loppu-->
	</div>

<?php endif; ?>


<!-- tyontekija -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2) : ?>
	<div class="row">
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Joko, työntekijän varten',Yii::app()->request->baseUrl.'/index.php/joko',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->
	</div>

<?php endif; ?>
<!-- tyontekija -->


 </div>
