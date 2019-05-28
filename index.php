<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="grid.css">
</head>
<body>
	<h4>Sudoku Validator</h4>
	<h3 id="validation">Validation: </h3>
	<h5 id="message"></h5>
	<div class="container">
		<?php
		for($row = 1; $row < 10; $row++)
		{
			for($slot = 1;$slot < 10; $slot++)
			{
				echo '<div class="item">
				<input type="text" id="cell_input"  name="row_'.$row.'_slot_'.$slot.'" size="1" maxlength="1">
				</div>';
			}
		}
		?>
	</div>
	<button onclick="postForm()" style="margin-top: 5px; ">Submit</button>
	<button onclick="auto_fill_boxes()" style="margin-top: 5px; ">Auto Fill</button>
	<br>
	<form id="finalize" style="visibility:hidden;" method="POST" action="process.php" onclick="validateMyForm();">
	<input type="hidden" id="hidden_data" name="data" value=""></input>
	<input type="submit" id="finalize" style="margin-top: 5px;" value="Draw Sudoku Board">
	</form>


	<script src="index.js"></script>
	<script>
		var sudoku;

		function postForm() 
		{
			document.querySelector("#hidden_data").value = '';
			var queryString = "";
			var form = document.querySelectorAll("#cell_input");

			var index = 0;
			var y_counter = 60;
			while(index != 81)
			{
				for(var i = 40; i < 450; i += 50)
				{
					var item = form[index];
					var modified_value = item.value;

					if(isNaN(item.value) == false)
					{
						modified_value = parseInt(item.value);
					}

					queryString += "form[]=" + JSON.stringify({
						"name" : item.name,
						"value" : modified_value,
						"position" : {x: i, y: y_counter},
						"valid" : false
					});
					if(index < 80) queryString += "&";
					index++;
				}

				y_counter += 50;
			}
			
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function()
			{
				if(this.readyState == 4 && this.status == 200)
				{
					try {
				        sudoku = JSON.parse(this.responseText);
				    } catch (e) {
				    	console.log(e);
						console.log(this.responseText);
				        return false;
				    }

				    document.querySelector("#validation").innerHTML = 'Validation: ';
				    document.querySelector("#message").innerHTML = '';

				    console.log(sudoku);
				    if(sudoku.errors.data === false)
				    {

				    	document.querySelector("#validation").innerHTML += markAllCellsValid().toString();

				    	queryString = queryString.slice(7);
					    for(var i = 1; i < 81;i++)
					    {
					    	queryString = queryString.replace('&form[]=',',');
					    }
					    
					    document.querySelector("#hidden_data").value = '{"data":['+queryString+']}';

				    } else if(!sudoku['errors'].hasOwnProperty('message')) {
				    	if(sudoku['errors']['data'].constructor === Array)
				    	{
				    		var messages = markErrors(sudoku.errors.data);
				    		var new_string = '';

				    		for(const index in messages)
				    		{
				    			if(messages[index].message.includes("digit(s).") === true)
				    			{
				    				if(new_string.includes("digit(s).") !== true)
				    				{
				    					new_string += messages[index].message;
				    				}
				    			} else if(messages[index].message.includes("Missing value(s).") === true){
				    				if(new_string.includes("Missing value(s).") !== true)
				    				{
				    					new_string += messages[index].message;
				    				}
				    			}
				    		}

				    		if(new_string.includes("digit(s).") && new_string.includes("Missing value(s)."))
				    		{
				    			new_string = 'Missing value(s) and Invalid digit(s). Please check all input fields in search for errors.';
				    		} else if(new_string.includes("Missing value(s).")) {
				    			new_string = 'Missing value(s). Please check all input fields in search for errors.';
				    		} else if(new_string.includes("digit(s).")) {
				    			new_string = 'Invalid digit(s). Please check all input fields in search for errors.';
				    		}

				    		document.querySelector("#message").innerHTML = new_string;
				    	} else {
				    		var message = markErrors([sudoku.errors.data]);
				    		document.querySelector("#message").innerHTML = message[0].message;
				    	}

				    	document.querySelector("#validation").innerHTML += 'false';
				    } else {
				    	var error_log = markErrors(sudoku.errors.data);
				    	var error_message = '';

				    	for(const index in error_log)
				    	{
				    		error_message += error_log[index].name + ' (' + error_log[index].value + ')';
				    		if(error_log.length - 1 != index) error_message += ', ';
				    	}


				    	document.querySelector("#message").innerHTML = 'The following cells: ' + error_message + '<br> are invalid.';
				    	document.querySelector("#validation").innerHTML += 'false';
				    }
				    
				    if(document.querySelector("#validation").innerHTML.includes("true"))
				    {
				    	document.querySelector('#finalize').style.visibility = 'visible';
				    } else {
				    	document.querySelector('#finalize').style.visibility = 'hidden';
				    }


				    return true;
				}
			}

			xmlHttp.open("POST","process.php",true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send(queryString);
		}

		function validateMyForm()
		{
			if(document.querySelector('#hidden_data').value == '')
			{
				return false;
			} else {
				return true;
			}
		}
	</script>
</body>
</html>