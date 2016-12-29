<?php



?>
 
 <legend><h2>Liikekirjeet</h2></legend>



	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Tarjouspyynnöt',Yii::app()->request->baseUrl.'/index.php/user',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Tarjoukset',Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Tilaukset',Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->

	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Tilausvahvistukset',Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->




<!--
 <div id="result"></div>
 <input type="hidden" id="yid" value="<?php echo $yid; ?>">

<script type="text/javascript">
$(document).ready(function(){


 openAjaxTiedosto();

 function openAjaxTiedosto(){

	var yid = $('#yid').val();

        $.ajax({
          type: 'POST',
          url: 'oma_kansio?yid='+yid,
          data: { ajax : "true" },
          success: function(data) {
		data=JSON.parse(data);
		//console.log(data);
		$('#result').html(data);
          },
          error:  function(xhr, str){
	    alert('error: ' + xhr.responseCode);
          }
        });

 };

});
</script>-->
