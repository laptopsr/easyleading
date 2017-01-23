<?php

 $path = Yii::app()->basePath."/../";
 $nextPath = "uploaded/tiedostot/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
 if (!file_exists($path . $nextPath)) {
 	mkdir($path . $nextPath, 0777, true);
 }

 if(isset($_POST['variables'][0]['kansionNimi']) and $_POST['variables'][0]['kansionNimi'] != ''){
	$uusikansio = $path.$_POST['variables'][0]['kansionSijainti'].'/'.$_POST['variables'][0]['kansionNimi'];
 	if (!file_exists($uusikansio)) {
 		mkdir($uusikansio, 0777, true);
 	}
 }

 if(isset($_POST['variables'][0]['poista']) and $_POST['variables'][0]['poista'] != ''){

 	if (file_exists($_POST['variables'][0]['poista'])) {
 		unlink($_POST['variables'][0]['poista']);
 	}
 }

 if(isset($_POST['variables'][0]['poistaKansio']) and $_POST['variables'][0]['poistaKansio'] != ''){


	function deleteDirectory($dirPath) {
	    if (is_dir($dirPath)) {
	        $objects = scandir($dirPath);
	        foreach ($objects as $object) {
	            if ($object != "." && $object !="..") {
	                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
	                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
	                } else {
	                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
	                }
	            }
	        }
	    reset($objects);
	    rmdir($dirPath);
	    }
	}

	deleteDirectory($_POST['variables'][0]['poistaKansio']);
 }
?>

<ul class="nav nav-tabs">
  <li role="presentation" class="active" id="paaKansio"><a href="#">Kotiin</a></li>
  <li role="presentation" id="luoKansio"><a href="#">Luo kansio</a></li>
  <li role="presentation" id="lataaTiedosto"><a href="#">Lataa tiedosto</a></li>
</ul>

<br>

<!-- Luo kansio -->
<?php if(isset($_POST['variables'][0]['luoKansio'])) : ?>
<div class="row" id="luoKansioLomake" style="display:none">
 <div class="col-sm-4">

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Uusi kansio</div>
  <div class="panel-body">
    <p class="form row">
    <div class="col-sm-12">

     <div class="row">
  	<label>Kansion nimi</label>
	<input type="text" id="kansionNimi" class="form-control">
     </div>

     <div class="row">
  	<label>Mihin alle luodaan kansio</label>
	<select id="kansionSijainti" class="form-control">
	<option value="<?php echo $nextPath; ?>">Pääkansio</option>
	<?php
	  function naytaKansiot($folder, $space) {
	    $files = scandir($folder);
	    foreach($files as $file) {
	      if (($file == '.') || ($file == '..')) continue;
	      $f0 = $folder.'/'.$file;
	
	      if (is_dir($f0)) {
	
	        echo '<option value="'.$f0.'">'.$file.'</option>';
	
	        naytaKansiot($f0, $space.'&nbsp;&nbsp;');
	      }
	    }
	  }
	  naytaKansiot($nextPath, "");
	?>
	</select>
     </div>

     <br>
     <div class="row">
	<button class="btn btn-primary luoUusiKansioSubmit">Luo</button>
     </div>
    </div>
    </p>
  </div>
</div>


 </div>
</div>
<?php endif; ?>
<!-- Luo kansio -->



<!-- Lataa tiedosto -->
<?php if(isset($_POST['variables'][0]['lataaTiedosto'])) : ?>
<div class="row" id="lataaTiedostoLomake" style="display:none">
 <div class="col-sm-4">

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Lataa tiedosto</div>
  <div class="panel-body">
    <p class="form row">
    <div class="col-sm-12">

     <form id="uusiTiedostoForm" action="oma_kansio" enctype="multipart/form-data" method="POST">
     <div class="row">
  	<label>Mihin kansioon</label>
	<select name="kansionSijainti" class="form-control">
	<option value="<?php echo $nextPath; ?>">Pääkansio</option>
	<?php
	  function naytaKansiot($folder, $space) {
	    $files = scandir($folder);
	    foreach($files as $file) {
	      if (($file == '.') || ($file == '..')) continue;
	      $f0 = $folder.'/'.$file;
	
	      if (is_dir($f0)) {
	
	        echo '<option value="'.$f0.'">'.$file.'</option>';
	
	        naytaKansiot($f0, $space.'&nbsp;&nbsp;');
	      }
	    }
	  }
	  naytaKansiot($nextPath, "");
	?>
	</select>
     </div>

     <div class="row">
  	<label>Tiedosto</label>
	<input type="file" name="fileUpload[]" multiple id="fileUpload" class="form-control">
     </div>
     </form>

     <br>
     <div class="row">
	<button class="btn btn-primary lataaTiedostoSubmit">Luo</button>
     </div>
    </div>
    </p>
  </div>
</div>


 </div>
</div>
<?php endif; ?>
<!-- Lataa tiedosto -->






<?php

/*
//echo '<pre>';
  function showTree($folder, $space) {
    $files = scandir($folder);
    foreach($files as $file) {
      if (($file == '.') || ($file == '..')) continue;
      $f0 = $folder.'/'.$file;
      if (is_dir($f0)) {
        echo '
	<div class="row" style="margin-left:'.$space.'px"> 
		<i class="fa fa-times link poistaKansio" pois="'.$folder.'/'.$file.'" aria-hidden="true" style="font-size:140%;color: red;"></i> 
		<i class="fa fa-folder-open" aria-hidden="true" style="font-size:140%;color: #ffa31a;"></i> 
		'.$file.'
	</div>';
        showTree($f0, ($space+20));
      } else {
	echo '
	<div class="row" style="margin-left:'.$space.'px"> 
		<i class="fa fa-times link poista" pois="'.$folder.'/'.$file.'" aria-hidden="true" style="font-size:120%;color: red;">
		</i> <i class="fa fa-file" aria-hidden="true" style="font-size:120%;color: #ccc;"></i> 
		<a href="../../'.$folder.'/'.$file.'">'.$file.'</a>
	</div>';
      }
    }
  }
  showTree($nextPath, "20");

//echo '</pre>';
*/
?>


<script type="text/javascript" >
$(document).ready( function() {

	$( '#container2' ).html( '<ul class="filetree start"><li class="wait">' + 'Generating Tree...' + '<li></ul>' );
	
	getfilelist( $('#container2') , '<?php echo $nextPath; ?>' );
	
	function getfilelist( cont, root ) {
	
		$( cont ).addClass( 'wait' );
			
		$.post( 'foldertree', { dir: root }, function( data ) {
	
			$( cont ).find( '.start' ).html( '' );
			$( cont ).removeClass( 'wait' ).append( data );
			if( '<?php echo $nextPath; ?>' == root ) 
				$( cont ).find('UL:hidden').show();
			else 
				$( cont ).find('UL:hidden').slideDown({ duration: 500, easing: null });
			
		});
	}
	
	$( '#container2' ).on('click', 'LI A', function() {
		var entry = $(this).parent();
		
		if( entry.hasClass('folder') ) {
			if( entry.hasClass('collapsed') ) {
						
				entry.find('UL').remove();
				getfilelist( entry, escape( $(this).attr('rel') ));
				entry.removeClass('collapsed').addClass('expanded');
			}
			else {
				
				entry.find('UL').slideUp({ duration: 500, easing: null });
				entry.removeClass('expanded').addClass('collapsed');
			}
		} else {
			//$( '#selected_file' ).text( "File:  " + $(this).attr( 'rel' ));
			window.location.href="../../" + $(this).attr( 'rel' ); 
		}
	return false;
	});
	
});
</script>


<div id="container2"> </div>
<!--<div id="selected_file"></div>-->
