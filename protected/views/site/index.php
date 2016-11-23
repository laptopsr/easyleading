<?php
/* @var $this SiteController */
?>

<?php if(!Yii::app()->user->isGuest) : ?>
 <div id="etusivu">

	<div class="row">
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/site/henkilosto?yritys='.Yii::app()->user->id,
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->
	</div>

 </div>
<?php else: ?>
Kirjaudu sisaan
<?php endif; ?>
