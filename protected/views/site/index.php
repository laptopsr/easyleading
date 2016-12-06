<?php
/* @var $this SiteController */
?>
<br>
<div id="etusivu">

 <div class="row"><!-- row-->
<!-- Admin -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->user->isAdmin()) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user/admin',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

<?php endif; ?>
<!-- Admin -->

<!-- Yrittaja -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 1) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Varasto rakenne',Yii::app()->request->baseUrl.'/index.php/varastoRakenne/index',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->


	 <?php
		$criteria = new CDbCriteria;
		$criteria->order = " id DESC ";
		$criteria->group = " varaston_nimike ";
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
			AND is_otsikko=1
		";
		$varastot = VarastoRakenne::model()->findAll($criteria);
	 ?>

	 <!--laatiko alka-->
	 <?php if (count($varastot) > 0): ?>
	 <div class="col-sm-3">

	   <select class="painike btn btn-primary btn-block btn-lg valitseVarasto">
	   <?php
	  		echo '<option value="">'.Yii::t('main', 'Valitse varasto').'</option>';
		foreach($varastot as $data){
	  		echo '<option value="'.Yii::app()->request->baseUrl.'/index.php/site/varasto?id='.$data->id.'">'.$data->varaston_nimike.'</option>';
		}
	   ?>
	   </select>

	 </div>

		<script>
		$(document).ready(function(){
		
		  $('.valitseVarasto').change(function(){ 
		      	var thisLink = $(this).val();
			window.location.href=thisLink;
		  });
		
		});
		</script>
	 <?php endif; ?>
	 <!--laatiko loppu-->



<?php endif; ?>
<!-- Yrittaja -->

<!-- tyontekija -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Joko, työntekijän varten',Yii::app()->request->baseUrl.'/index.php/joko',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->


<?php endif; ?>
<!-- tyontekija -->


<!-- uusi viesti -->
<?php if( !Yii::app()->user->isGuest and $isMessage ) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Sinulla on uusi viesti',Yii::app()->request->baseUrl.'/index.php/viestinta/index',
			array('class'=>'painike btn btn-warning btn-block btn-lg vilkku')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

<?php endif; ?>
<!-- uusi viesti -->



 </div><!-- row-->
</div><!-- etusivu -->



	
