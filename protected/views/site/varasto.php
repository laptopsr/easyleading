<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="form-inline">
  <div class="form-group">
	<button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#demo">
		<i class="fa fa-plus" aria-hidden="true"></i> Luo tuote <i class="caret"></i>
	</button>
  </div>
  <div class="form-group">
	<button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#varastonRyhmittely">
		Varaston ryhmittely <i class="caret"></i>
	</button>
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
  <div class="col-sm-6">
   <br>
   <div class="panel panel-primary">
     <div class="panel-heading">Uusi tuote</div>
     <div class="panel-body">

	<?php echo $this->renderPartial('_form_varasto', array('model'=>$model)); ?>

    </div>
   </div>
  </div>
 </div>

 <div id="varastonRyhmittely" class="row collapse">
  <div class="col-sm-12">
   <br>
   <div class="panel panel-primary">
     <div class="panel-heading">Varaston ryhmät</div>
     <div class="panel-body">

	<?php echo $this->renderPartial('//varastoCategory/_form', array('model'=>$varastoCategory, 'varaston_nimike'=>$varasto->varaston_nimike)); ?>

    </div>
   </div>
  </div>
 </div>


<br>
   <div class="panel panel-primary">
     <div class="panel-heading">Varasto</div>
     <div class="panel-body">


<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " varaston_nimike='".$varasto->varaston_nimike."' ";
	$varastoOtsikkot = VarastoOtsikkot::model()->findAll($criteria);


	$criteria = new CDbCriteria;
/*
	if(isset($_GET['sort']))
	{
	$criteria->order = " 
	( 
		SELECT value FROM varasto_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')." 
		WHERE sarakkeen_nimi='".$_GET['sort']."'
		AND varaston_nimike='".$varasto->varaston_nimike."' order by value

	) 
	";
	}
*/

	$criteria->group = " tr_rivi ";
	$criteria->condition = " 
		varaston_nimike='".$varasto->varaston_nimike."'
	";
	$varastoRivit=new CActiveDataProvider('VarastoRakenne', array(
		'criteria'=>$criteria,
		//'pagination'=>false
	));
	$varastoRivit->pagination->pageSize = 20;

	//  <-- Tyoteryhmat
	$criteria = new CDbCriteria;
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
		AND varaston_nimike='".$varasto->varaston_nimike."' 
	";
	$tyoteryhmat = VarastoCategory::model()->find($criteria);
	$ryhmat = json_decode($tyoteryhmat->ryhmarakenne, true);
	//  Tyoteryhmat -->
?>
<div class="row">

 <div class="col-sm-3">
   <div class="panel panel-default">
     <div class="panel-heading">Valitse Tuoteryhmä</div>
     <div class="panel-body">
	<div class="list-group">
	<?php
	if(is_array($ryhmat))
	{
		$this->handle($ryhmat);
		echo '<br>';
	}
	?>
	</div>
     </div>
  </div>
 </div>

 <div class="col-sm-9">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo $varasto->varaston_nimike; ?></div>
     <div class="panel-body">

      <table id="varastoTaulu" class="display table table-striped" cellspacing="0" width="100%">
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

			echo '<th>'.CHtml::link($data->sarakkeen_nimi,'varasto?id='.$id.'&sort='.$data->sarakkeen_nimi).'</th>';
		}
			echo '<th></th>';
		echo '</tr>';
	?>

	</thead>
	<tbody>

	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$varastoRivit,
		'itemView'=>'_view_varasto_taulu',
		'viewData' => array( 'varastoOtsikkot' => $varastoOtsikkot, 'varasto' => $varasto ),
	  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',
	

		'pager' => array(
	           'firstPageLabel'=>'<<',
	           'prevPageLabel'=>'< Edellinen',
	           'nextPageLabel'=>'Seuraava >',
	           'lastPageLabel'=>'>>',
	           //'maxButtonCount'=>'10',
	           'header'=>'<h3>Siirry sivulle:</h3>',
	           'cssFile'=>false,
	       ), 
	
	)); ?>
	</tbody>
      </table>

    </div>
  </div>
 </div>
</div>



    </div>
  </div>
 </div><!--Varasto-->


<?php /*
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
*/?>

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

/*
$('#varastoTaulu').DataTable({
        //"scrollY": 200,
        //"scrollX": true
});
*/


});
</script>


