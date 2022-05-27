  $( function() {
    $( ".inp_date" ).datepicker({
		
		dateFormat: "yy-mm-dd"
		
	});
  } );
  


 function date_validation(){
	
	
			
			var first_date=document.getElementById('start_date').value;
			var end_date=document.getElementById('end_date').value;
			

			if(first_date==false || end_date==false)
			{
				$('#date_alert_empty').show('fade');
				
				setTimeout(function () {
				$('#date_alert_empty').hide('fade');
				}, 2000);
					
			}
			else if(first_date>end_date)
			{
				$('#date_alert').show('fade');
				
				setTimeout(function () {
				$('#date_alert').hide('fade');
				}, 2000);

				
			}
			else{
				
				document.getElementById("date_form").submit();
			}
			
			
		}
