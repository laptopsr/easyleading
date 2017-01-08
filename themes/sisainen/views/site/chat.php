<?php

?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Chatti
                            </h1>
                            <ol class="breadcrumb">
				<span class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Chatissä voit lähettää ja vastaanottaa viestejä oman yrityksesi muilta käyttäjiltä.">
				 <i class="fa fa-info" aria-hidden="true"></i>
				</span>

                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">chatti</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



<!-- chat -->
<?php
	Yii::app()->user->setState('chatCount', null);
?>

<?php if(!Yii::app()->user->isGuest) : ?>
<style>
#chatBody{
	height:400px;
	overflow:scroll;
	overflow-x:hidden;
}
</style>




<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Viestit</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
   <div class="table-responsive">


   	<div id="forChat"></div>

	<div class="row">
	  <div class="col-lg-6">
	    <div class="input-group">
	      <input type="text" id="teksti" class="form-control" placeholder="Kirjoita tähän...">
	      <span class="input-group-btn">
	        <button class="btn btn-primary laheta" type="button">Lähetä</button>
	      </span>
	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->


   </div>
 </div>
</div>
<!-- /.portlet -->



<script type="text/javascript">
$(document).ready(function(){

$(function() {
    startRefresh();
});

function startRefresh() {
    setTimeout(startRefresh,3000);
    $.get('chat_ajax', function(data) {
	data=JSON.parse(data);
    	$('#forChat').html(data);
        var d = $("#chatBody");
	if(data != '')
        d.scrollTop(d[0].scrollHeight);

    });
}

    $('#teksti').keypress(function(e) {
        if(e.which == 13) {
            $('.laheta').click();
        }
    });

$('.laheta').click(function(){

	var teksti = $('#teksti').val();
        $.ajax({
           url: 'chat_ajax',
	   type: 'POST',
	   data: { newMessage : "true", teksti : teksti },
           success: function(data){
		data=JSON.parse(data);
		//console.log(data);
		$('#forChat').html(data);
		$('#teksti').val('');
              },
	   error:function(data){
		console.log(data);
	   }
        });

});


});
</script>
<?php endif; ?>
<!-- chat -->
