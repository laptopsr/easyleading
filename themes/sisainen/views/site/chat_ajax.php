<?php 
if(count($chat) > 0)
{
	$body = '<div id="chatBody">';
	foreach(array_reverse($chat) as $data)
	{
		$data->text = str_replace(":-)","<img src='../../img/chat/smile.png' height=30>",$data->text);

		$body .= '
		<div class="row" style="margin-bottom: 3px;">
		  <div class="col-sm-3">
			'.date("H:i", strtotime($data->time)).'
			<b>'.$data->owner.'</b>
		  </div>
		  <div class="col-sm-9">
			'.$data->text.'
		  </div>
		</div>
		';
	}
	$body .= '</div>';
	echo json_encode($body);
} else {
	echo json_encode('');
}
?>

