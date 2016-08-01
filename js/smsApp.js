
$(document).ready(function(){
	var form = document.getElementById('csvToJson');
	var fileSelect = document.getElementById('selectCsv');
//var csv is the CSV file with headers
 $('#selectCsv').change(function(event) {
    var tmppath = event.target.files[0].name;
		var dataString =  'csvFile='+ tmppath; 
	$.ajax({  
      type: "POST",  
      url: "http://localhost/smsApp/csv.php",  
      data: dataString,  
      success: function(output) {  
	  alert(output);
	  },
	  error: function(requst, status, error){
		alert(error);
    
		}
    });  
	});
	$('#subjectinput').attr("maxlength", 13)
});