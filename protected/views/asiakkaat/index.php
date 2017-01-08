<?php
/* @var $this AsiakkaatController */
/* @var $dataProvider CActiveDataProvider */
?>

<legend><h1>Asiakkaat</h1></legend>


<div class="panel panel-info">
  <div class="panel-heading">Haku</div>
  <div class="panel-body">
    <div class="row">
    <form action="#" method="POST">   
     <div class="col-sm-2">
	<input type="text" name="osoite" class="form-control" placeholder="Osoite" value="<?php if(isset($_POST['osoite'])) echo $_POST['osoite']; ?>">
     </div>
     <div class="col-sm-2">
	<input type="text" name="sahkoposti" class="form-control" placeholder="Sähköposti" value="<?php if(isset($_POST['sahkoposti'])) echo $_POST['sahkoposti']; ?>">
     </div>
     <div class="col-sm-2 col-sm-offset-6">
	<input type="submit" class="btn btn-block btn-info" value="HAE">
     </div>
    </form>
    </div>
  </div>
</div>




<div class="panel panel-info">
  <div class="panel-heading">Asiakkaat</div>
  <div class="panel-body">
    <div class="table-responsive">
     <table class="table table-hovered">
     <tr>
 	<th></th>
 	<th>Yritys/Yksityshenkilö</th>
 	<th>osoite</th>
 	<th>sahkoposti</th>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		//'viewData' => array( 'netvisor' => $netvisor ),
	  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',
	)); ?>
     </table>
    </div>
  </div>
</div>
