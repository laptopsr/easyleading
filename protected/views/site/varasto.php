<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="form-inline">
<div class="form-group">
	<button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#demo"><i class="fa fa-plus" aria-hidden="true"></i> Luo tuote <i class="caret"></i></button>
</div>
<div class="form-group">
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


	 <select class="form-control input-lg valitseVarasto">
	 <?php
	 	echo '<option value="">'.Yii::t('main', 'Vaihda varasto').'</option>';
		foreach($varastot as $data){
	  		echo '<option value="'.Yii::app()->request->baseUrl.'/index.php/site/varasto?id='.$data->id.'">'.$data->varaston_nimike.'</option>';
		}
	 ?>
	 </select>



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

</div>
</div>


 <div id="demo" class="row collapse">
  <div class="col-sm-4">
   <br>
   <div class="panel panel-primary">
     <div class="panel-heading">Uusi tuote</div>
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
		AND varaston_nimike='".$varasto->varaston_nimike."'
	";
	$varastoOtsikkot = VarastoOtsikkot::model()->findAll($criteria);


	$criteria = new CDbCriteria;
	$criteria->group = " tr_rivi ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND varaston_nimike='".$varasto->varaston_nimike."'
	";
	$varastoRivit = VarastoRakenne::model()->findAll($criteria);


?>
<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo $varasto->varaston_nimike; ?></div>
     <div class="panel-body">

      <table id="varastoTaulu" class="display" cellspacing="0" width="100%">
	<thead>

	<?php 
		$sarakkeen_nimi = array();
		echo '<tr>';
		foreach($varastoOtsikkot as $data)
		{	
			$checkAlasveto = explode(":", $data->sarakkeen_nimi);
			if (isset($checkAlasveto[0]))
			$data->sarakkeen_nimi = $checkAlasveto[0];

			$sarakkeen_nimi[$data->sarakkeen_nimi] = $data->sarakkeen_nimi;

			echo '<th>'.$data->sarakkeen_nimi.'</th>';
		}
			echo '<th></th>';
		echo '</tr>';
	?>

	</thead>
	<tbody>

	<?php 
	foreach($varastoRivit as $dataRivit)
	{
		$sarakkeen_nimi = array();
		echo '<tr>';
		foreach($varastoOtsikkot as $data)
		{	
			$value = '';
			$criteria = new CDbCriteria;
			$criteria->order = " id,position ASC ";
			$criteria->condition = " 
				yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
				AND varaston_nimike='".$varasto->varaston_nimike."'
				AND tr_rivi='".$dataRivit->tr_rivi."'
				AND sarakkeen_nimi='".$data->sarakkeen_nimi."'
			";
			$values = VarastoRakenne::model()->find($criteria);
			if(isset($values->id)) $value = $values->value;

			echo '<td>'.$value.'</td>';
		}
			echo '<td><button class="pull-right btn btn-danger btn-sm poista" yid="'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid').'" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$dataRivit->tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
		echo '</tr>';
	}
	?>
	</tbody>
      </table>

    </div>
  </div>
 </div>
</div>



<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){

$('.poista').click(function(){

	var yid = $(this).attr('yid');
	var varaston_nimike = $(this).attr('varaston_nimike');
	var tr_rivi = $(this).attr('tr_rivi');

        $.ajax({
           url: 'varaston_poisto',
	   type: 'POST',
	   data: { yid : yid, varaston_nimike : varaston_nimike, tr_rivi : tr_rivi },
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


$('#varastoTaulu').DataTable({
        //"scrollY": 200,
        //"scrollX": true
});



});
</script>


