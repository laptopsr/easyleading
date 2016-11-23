$(document).ready(function(){



 var pvmVal = $("#valiko_pvm").val();
 pvmGet(pvmVal);

$("#valiko_pvm").change(function(){
   	pvmVal = $(this).val();
	pvmGet(pvmVal);
});


function pvmGet(pvmVal)
{

   $.ajax({
   url: 'analyysi_pvm',
      type: "POST",
      data: { pvm : pvmVal },
      	success: function(data){
  	  	//console.log(data);
		data = JSON.parse(data);


	var ids = $(data).map(function() {
	    return parseInt(this.y, 10);
	}).get();
	
	var maxvalue = Math.max.apply(Math, ids);

	console.log(maxvalue);
	if(maxvalue == 0)
	{
		$('#container').html('<div class="alert alert-info">Tällä päivämäärällä et ole merkannut syötävää</div>');
		return false;
	}
	


var change = {
    100: 'SUOSITUS',
    150: 'RUNSAASTI',
    200: 'LIIKA',
};

    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column',
            //height: 600
	    backgroundColor: '#ededed'
        },
        title: {
            text: 'Ruoka analyysi'
        },
      /*  subtitle: {
            text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
        },*/
        xAxis: {
            type: 'category'
        },
yAxis: {
    min: 0, max: 200,
    labels: {

        formatter: function() {
            var value = change[this.value];

	    if((this.value > 150) && (this.value < 200))
	    value = 'RUNSAASTI';
/*
	    if((this.value < 100))
	    value = 'SUOSITUS';
	    if((this.value > 150) && (this.value < 200) && (this.value > 100))
	    value = 'RUNSAASTI';
	    if((this.value > 200))
	    value = 'LIIKA';
*/
            return value;
        },

    },
            title: {
                text: false

        },
},

        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: false,
                    format: '{point.y:.1f}'
                }
            }
        },

	//tooltip: false;

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name} </span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: syöty <b>{point.y:.2f}%</b> suosituksesta<br/>'
        },

        series: [{
            name: 'Ravintoaine',
            colorByPoint: true,


            data: data


        }]
    });


      	},
  	error:function(data){
  		console.log(data); 
  	}
   });
}
 



});
