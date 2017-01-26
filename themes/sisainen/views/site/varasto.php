<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Varasto <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index'; ?>" data-toggle="tooltip" data-placement="right" title="Luo uusi varasto"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li>varasto</li>
                                <li class="active"><?php echo $varasto->varaston_nimike; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->


<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/easyTree.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/easyTree.js"></script>
<style>
#varastoTaulu td{ white-space: nowrap; }
.ryhmanVaihto { cursor: pointer }
.ryhmanVaihto:hover { color: red }
</style>

<input type="hidden" class="form-control" id="backLinkID" value="<?php echo $_GET['id']; ?>">

<div class="form-inline">
  <div class="form-group">
	<button class="btn btn-default btn-lg" data-toggle="collapse" data-target="#demo" title="Luo täällä uusi tuote varastoon.">
		<i class="fa fa-plus" aria-hidden="true"></i> Luo tuote <i class="caret"></i>
	</button>
  </div>
  <div class="form-group">
	<button class="btn btn-default btn-lg" data-toggle="collapse" data-target="#varastonRyhmittely" title="Luo täällä kustannuspaikkajärjestys ennen tuotteiden luomista, jotta tuotteiden löytyminen varastosta on helpompaa.">
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

 <div id="ilmoitus"></div>

<div id="demo" class="collapse">
 <br>
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Luo tuote</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


	<?php echo $this->renderPartial('_form_varasto', array('model'=>$model)); ?>

   </div>
  </div>
 </div>
<!-- /.portlet -->
</div>

<div id="varastonRyhmittely" class="collapse">

 <br>
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Varaston ryhmittely</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">

	<?php echo $this->renderPartial('//varastoCategory/_form', array('model'=>$varastoCategory, 'varaston_nimike'=>$varasto->varaston_nimike)); ?>

   </div>
  </div>
 </div>
<!-- /.portlet -->
</div>


<br>
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Varasto</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " varaston_nimike='".$varasto->varaston_nimike."' AND naytetaan_taulussa=1 ";
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
	if(isset($_GET['etsi'])){
	$criteria->addCondition (" tuotteen_ryhman_nimike LIKE '%".$_GET['etsi']."%' ");	
	}

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
	if(isset($tyoteryhmat->ryhmarakenne) and !empty($tyoteryhmat->ryhmarakenne))
		$thisTree = json_decode($tyoteryhmat->ryhmarakenne);
	else
		$thisTree = $this->malli();
	//  Tyoteryhmat -->
?>


<div class="row">

 <div class="col-sm-3">

<!-- /.portlet -->
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Valitse tuoteryhmä</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


	<div class="list-group">
		<?php echo CHtml::link('Näytä kaikki tuotteet','varasto?id='.$id); ?>
    	  <div class="easy-tree" id="varastonNakyma">
		<?php echo $thisTree; ?>
	  </div>
	</div>

   </div>
  </div>
 </div>
<!-- /.portlet -->

<input type="hidden" value="<?php echo $id; ?>" id="varastoId">
<script>
    (function ($) {
        function init() {
            $('#varastonNakyma').EasyTree({
                addable: false,
                editable: false,
                deletable: false
            });
        }
        function init2() {
            $('#thisTree').EasyTree({
                addable: true,
                editable: true,
                deletable: true
            });
        }
        window.onload = init();
        window.onload = init2();
    })(jQuery)

$(document).ready(function(){

	var arr = $('#varastonNakyma').find("a").map(function() { 
		$('#VarastoOtsikkot_tuotteen_ryhman_nimike').append("<option value='"+$(this).text().trim()+"'>"+$(this).text().trim()+"</option>");
	}).get();
	console.log( arr );


  $('#varastonNakyma').find("a").click(function(){
	var thisId = $('#varastoId').val();
	var thisText = $(this).text().trim();
	window.location.href='varasto?id='+thisId+'&etsi='+thisText
  });

});
</script>

 <div class="col-sm-9">
<!-- /.portlet -->
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4><?php echo $varasto->varaston_nimike; ?></h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


      <div class="table-responsive">
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
			echo '<th>Ryhmä</th>';
			echo '<th></th>';
		echo '</tr>';
	?>

	</thead>
	<tbody>

	<?php 
	$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$varastoRivit,
		'itemView'=>'_view_varasto_taulu',
		'viewData' => array( 'varastoOtsikkot' => $varastoOtsikkot, 'varasto' => $varasto, 'nextPath' => $nextPath ),
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
<!-- /.portlet -->



   </div>
  </div>
 </div>
<!-- /.portlet -->


<?php /*
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
*/?>

<div id="showres" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


<script type="text/javascript">
$(document).ready(function(){


 jQuery.fn.clickToggle = function(a,b) {
  function cb(){ [b,a][this._tog^=1].call(this); }
  return this.on("click", cb);
 };

 $('.Muokkaaminen').clickToggle(
  function() {
    $(this).closest("tr").find('span').each(function(){
      var t = $(this).text();
      $(this).html($('<input >',{'value' : t, 'class' : 'form-control'}));
    });
  },
  function() {
    $(this).closest("tr").find('span').each(function(){
      var inp = $(this).find('input');
      if (inp.length){
        $(this).text(inp.val());
      }
    });
  });




 $(document).delegate(".values input","keyup",function(){
	$(this).closest("tr").find('.Muokkaaminen').html('<i class="fa fa-floppy-o" aria-hidden="true"></i>').removeClass('btn-warning').addClass('btn-success');
	var riviID	 	= $(this).closest('span').attr('riviID');
	var varaston_nimike 	= $(this).closest('span').attr('varaston_nimike');
	var tr_rivi		= $(this).closest('span').attr('tr_rivi');
	var sarakkeen_nimi	= $(this).closest('span').attr('sarakkeen_nimi');
	var sarakkeen_tyyppi	= $(this).closest('span').attr('sarakkeen_tyyppi');
	var sum			= $(this).closest('span').attr('sum');
	var position		= $(this).closest('span').attr('position');
	var varaston_nimike_id	= $(this).closest('span').attr('varaston_nimike_id');
	var tuotteen_ryhman_nimike= $(this).closest('span').attr('tuotteen_ryhman_nimike');
	var thisNewValue	= $(this).val();

	if(thisNewValue.length > 1)
	{
        $.ajax({
           url: 'keyup_updater',
	   type: 'POST',
	   data: { riviID : riviID, varaston_nimike : varaston_nimike, sarakkeen_nimi : sarakkeen_nimi, tr_rivi : tr_rivi, thisNewValue : thisNewValue, sarakkeen_tyyppi : sarakkeen_tyyppi, sum : sum, position : position, varaston_nimike_id: varaston_nimike_id, tuotteen_ryhman_nimike : tuotteen_ryhman_nimike },
           success: function(data){
		data=JSON.parse(data);
		console.log(data);
		//if(data['newId'])
		//joko
              },
	   error:function(data){
		console.log(data);
	   }
        });
	}
 });

 $('.poista').click(function(){

	var varaston_nimike = $(this).attr('varaston_nimike');
	var tr_rivi = $(this).attr('tr_rivi');

        $.ajax({
           url: 'varaston_poisto',
	   type: 'POST',
	   data: { varaston_nimike : varaston_nimike, tr_rivi : tr_rivi },
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



 $('.getModal').click(function(){

	var varaston_nimike = $(this).attr('varaston_nimike');
	var tr_rivi = $(this).attr('tr_rivi');
	var tuotteen_ryhman_nimike = $(this).attr('tuotteen_ryhman_nimike');
	var backLinkID = $('#backLinkID').val();

        $.ajax({
           url: 'getModal',
	   type: 'POST',
	   data: { backLinkID : backLinkID, varaston_nimike : varaston_nimike, tr_rivi : tr_rivi, tuotteen_ryhman_nimike : tuotteen_ryhman_nimike },
           success: function(data){
		data=JSON.parse(data);
		//console.log(data);
		$('#showres').modal().html(data);
              },
	   error:function(data){
		console.log(data);
	   }
        });

 });


 $(document).delegate(".saveModalForm","click",function(){

$('#modalForm').submit();
/*
 	var msg   = $('#modalForm').serialize();
        $.ajax({
          type: 'POST',
          url: 'saveModal',
          data: msg,
          success: function(data) {
		//$('#ilmoitus').html(data);
		console.log(data);
		//window.location.reload();
          },
          error:  function(xhr, str){
	    alert('error: ' + xhr.responseCode);
          }
        });
*/

 });



 $('.openModalImage').click(function(){

   var kuvat = '';
   var riviId = $(this).attr('riviId');

        $.ajax({
          type: 'POST',
          url: 'annaKaikkiKuvat',
          data: { id : riviId },
	  async : false,
          success: function(data) {
		data=JSON.parse(data);
		console.log(data);
		kuvat = data;
          },
          error:  function(xhr, str){
	    alert('error: ' + xhr.responseCode);
          }
        });


   $('#showres').modal().html(''+
  '<div class="modal-dialog">' +
    '<div class="modal-content">' +
      '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
        '<h4 class="modal-title" id="myModalLabel">Tuotekuvat</h4>' +
      '</div>' +
      '<div class="modal-body">' 
         + kuvat +
      '</div>' +
      '<div class="modal-footer">' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>' +
      '</div>' +
    '</div>' +
  '</div>'
   );

 });

});
</script>


