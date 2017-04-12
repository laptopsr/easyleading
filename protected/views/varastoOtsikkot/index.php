<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading">Varastoitavan tuotteen lomakkeen luonti</div>
     <div class="panel-body">

	<?php echo $this->renderPartial('//varastoOtsikkot/_form', array('model'=>$model)); ?>

    </div>
  </div>
 </div>
</div>

<h1>Varastoitavan tuotteen lomakesarakkeet</h1>

<?php foreach($varastot as $data): ?>
<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND varaston_nimike='".$data->varaston_nimike."'
	";
	$varasto = VarastoOtsikkot::model()->findAll($criteria);
?>
<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo $data->varaston_nimike; ?></div>
     <div class="panel-body">

     <div class="table-responsive">
      <table class="table table-bordered">
       <tr>
	<?php foreach($varasto as $data): ?>
	  <?php echo $this->renderPartial('//varastoOtsikkot/_view', array('data'=>$data)); ?>
	<?php endforeach; ?>
       </tr>
      </table>
    </div>

    </div>
  </div>
 </div>
</div>
<?php endforeach; ?>
