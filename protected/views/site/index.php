<?php
/* @var $this SiteController */
?>
<br>
<div id="etusivu">

 <div class="row">
<!-- Admin -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->user->isAdmin()) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user/admin',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
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
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Varaston rakenne',Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->


	 <?php
		$criteria = new CDbCriteria;
		$criteria->order = " id DESC ";
		$criteria->group = " varaston_nimike ";
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		";
		$varastot = VarastoOtsikkot::model()->findAll($criteria);
	 ?>

	 <!--laatiko alka-->
	 <?php if (count($varastot) > 0): ?>
	 <div class="col-sm-3">

	   <select class="painike input-lg btn-block valitseVarasto">
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


	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Liikekirjeet',Yii::app()->request->baseUrl.'/index.php/site/oma_kansio',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->
<br><br><br>
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Tuotanto',Yii::app()->request->baseUrl.'/index.php/tuotanto',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Asiakkaat',Yii::app()->request->baseUrl.'/index.php/asiakkaat',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->



<?php endif; ?>
<!-- Yrittaja -->

<!-- tyontekija -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2) : ?>

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Joko, työntekijän varten',Yii::app()->request->baseUrl.'/index.php/joko',
			array('class'=>'painike btn btn-info btn-block btn-lg')); 
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



	
