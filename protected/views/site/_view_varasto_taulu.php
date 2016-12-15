<?php

		$sarakkeen_nimi = array();
		echo '<tr>';
		foreach($varastoOtsikkot as $dataOtsikko)
		{	
			$value = '';
			$criteria = new CDbCriteria;
			$criteria->condition = " 
				yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
				AND varaston_nimike='".$varasto->varaston_nimike."'
				AND tr_rivi='".$data->tr_rivi."'
				AND sarakkeen_nimi='".$dataOtsikko->sarakkeen_nimi."'
			";
			$values = VarastoRakenne::model()->find($criteria);
			if(isset($values->id)) $value = $values->value;

			echo '<td>'.$value.'</td>';
		}
			echo '<td><button class="pull-right btn btn-danger btn-sm poista" yid="'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid').'" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$data->tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
		echo '</tr>';

?>
