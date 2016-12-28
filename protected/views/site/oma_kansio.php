<?php



?>
 
 <legend><h2>Omat tiedostot</h2></legend>


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
</script>
