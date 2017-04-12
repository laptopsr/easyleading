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


<!--Back--><!--
<p>
	<?php echo CHtml::link('<i class="fa fa-backward" aria-hidden="true"></i>',Yii::app()->request->urlReferrer, 
		array(
			'class'=>'btn btn-default', 
			'data-toggle'=>'tooltip', 
			'data-placement'=>'top', 
			'title'=>Yii::t('main', 'Takaisin')
		)); 
	?>-->
<span class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Chatissä voit lähettää ja vastaanottaa viestejä oman yrityksesi muilta käyttäjiltä.">
			<i class="fa fa-info" aria-hidden="true"></i>
		</span>
</p>
<!--Back-->


<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo Yii::app()->name; ?> chatti</div>
     <div class="panel-body">

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
</div>



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
