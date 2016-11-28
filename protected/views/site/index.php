<?php
/* @var $this SiteController */
?>

<?php if(!Yii::app()->user->isGuest) : ?>
 <div id="etusivu">

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

 </div>
<?php else: ?>
Kirjaudu sisaan
<?php endif; ?>
