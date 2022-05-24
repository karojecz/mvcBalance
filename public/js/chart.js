// Load google c
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values


 

function drawChart() {

var data = new google.visualization.DataTable();

data.addColumn('string', 'Category name');
data.addColumn('number', 'Sum');
		for (var key in myArr) {
    var value = myArr[key];
		var sum=parseFloat(value.sum);
	data.addRow([value.name,sum]);
}



  // Optional; add a title and set the width and height of the chart
  var options = {
	  'title':"Your expenses",
	  'legend': 'top'   
	  };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
  
  

	
}
    $(window).resize(function(){
        drawChart();
    });