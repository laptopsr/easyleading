<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading">Luo tuote</div>
     <div class="panel-body">

	<?php echo $this->renderPartial('_form_varasto', array('model'=>$model)); ?>

    </div>
  </div>
 </div>
</div>

<h1>Varasto</h1>


<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND is_otsikko=1
		AND varaston_nimike='".$varasto->varaston_nimike."'
	";
	$varastoOtsikkot = VarastoRakenne::model()->findAll($criteria);



	$criteria = new CDbCriteria;
	$criteria->order = " id,position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND is_otsikko=0
		AND value!=''
		AND varaston_nimike='".$varasto->varaston_nimike."'
	";
	$varastoValues = VarastoRakenne::model()->findAll($criteria);


?>
<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo $varasto->varaston_nimike; ?></div>
     <div class="panel-body">

      <table class="table">

	<tr>
	<?php 
		$sarakkeen_nimi = array();
		foreach($varastoOtsikkot as $data)
		{	
			$sarakkeen_nimi[$data->sarakkeen_nimi] = $data->sarakkeen_nimi;
			echo '<th>'.$data->sarakkeen_nimi.'</th>';
		}
			echo '<th></th>';
	?>
       <tr>

	<?php

		echo '<tr>';
		foreach($varastoValues as $data)
		{	

			if(isset($firstSarake) and $firstSarake == $data->sarakkeen_nimi)
			{
			echo '<td><button class="btn btn-danger btn-sm poista" yid="'.$data->yid.'" varaston_nimike_id="'.$data->varaston_nimike_id.'" tr_rivi="'.$data->tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
				echo '</tr><tr>';
				unset($firstSarake);
			}


			echo '<td>'.$data->value.' ('.$data->sarakkeen_nimi.')</td>';


			if(!isset($firstSarake))
			{
				$firstSarake = $data->sarakkeen_nimi;
			}

			$varaston_nimike_id 	= $data->varaston_nimike_id;
			$tr_rivi 		= $data->tr_rivi;
			$yid 			= $data->yid;
		}
		if(isset($varaston_nimike_id))
			echo '<td><button class="btn btn-danger btn-sm poista" yid="'.$yid.'" varaston_nimike_id="'.$varaston_nimike_id.'" tr_rivi="'.$tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button></td>';

	?>

      </table>

    </div>
  </div>
 </div>
</div>




<script type="text/javascript">
$(document).ready(function(){

$('.poista').click(function(){

	var yid = $(this).attr('yid');
	var varaston_nimike_id = $(this).attr('varaston_nimike_id');
	var tr_rivi = $(this).attr('tr_rivi');

        $.ajax({
           url: 'varaston_poisto',
	   type: 'POST',
	   data: { yid : yid, varaston_nimike_id : varaston_nimike_id, tr_rivi : tr_rivi },
           success: function(data){
		data=JSON.parse(data);
		console.log(data);
		window.location.reload();
              },
	   error:function(data){
		console.log(data);
	   }
        });

});


});
</script>


