
var url = 'http://thallinta.vetel.fi/index.php/api/tags';
var tyontekija = '';


function ready() {

    function onNfc(nfcEvent) {

        var tag = nfcEvent.tag;
        var tagId = nfc.bytesToHexString(tag.id);
   	document.getElementById('tagginro').value = tagId;


$(document).ready(function(){


        $.ajax({
           url: url+'/tarkistaminen',
	   type:'POST',
	   async: false,
 	   data: { tag_id : tagId },
           success: function(data){
        	console.log(data);
		data = JSON.parse(data);

		tyontekija = data['tyontekija'];
		$("#result2").html(data['bd']).show();

    	},
    		error:function (xhr, ajaxOptions, thrownError){
        	console.log(xhr.responseText);
		$("#result2").html(xhr.responseText).show();
    	}
        });


});

    }

    function win() {
        console.log("Listening for NFC Tags");
    }

    function fail(error) {
        alert("Error adding NFC listener");
    }


    nfc.addTagDiscoveredListener(onNfc, win, fail);
}

function init() {
    document.addEventListener('deviceready', ready, false);
}

init();





$(document).ready(function(){


  $(document).delegate(".tyo","click",function(){
   	if(tyontekija !== '')
	{
		tilanne(tyontekija,1);
	}
  });

  $(document).delegate(".lounastauko","click",function(){
   	if(tyontekija !== '')
	{
		tilanne(tyontekija,2);
	}
  });

  function tilanne(tyontekija,t)
  {


        $.ajax({
           url: url+'/luorivi',
	   type:'POST',
	   async: false,
 	   data: { tyontekija : tyontekija, status : t },
           success: function(data){
        	console.log(data);
		data = JSON.parse(data);

		$("#result2").html(data).show();

    	},
    		error:function (xhr, ajaxOptions, thrownError){
        	console.log(xhr.responseText);
		$("#result2").html(xhr.responseText).show();
    	}
        });

  }
  

  $(document).delegate(".tyolopetus","click",function(){
   	if(tyontekija !== '')
	{
		var tags = $(this).attr('tags');
		tilanneLop(tyontekija,tags);
	}
  });

  $(document).delegate(".lounastaukolopetus","click",function(){
   	if(tyontekija !== '')
	{
		var tags = $(this).attr('tags');
		tilanneLop(tyontekija,tags);
	}
  });

  function tilanneLop(tyontekija,tags)
  {


        $.ajax({
           url: url+'/suljerivi',
	   type:'POST',
	   async: false,
 	   data: { tyontekija : tyontekija, tags : tags },
           success: function(data){
        	console.log(data);
		data = JSON.parse(data);

		$("#result2").html(data).show();

    	},
    		error:function (xhr, ajaxOptions, thrownError){
        	console.log(xhr.responseText);
		$("#result2").html(xhr.responseText).show();
    	}
        });

  }


});






