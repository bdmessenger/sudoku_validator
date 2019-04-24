<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="grid.css">
</head>
<body>
	<h3>Sudoku Validator</h3>
	<h5>Validation: </h5>
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


	<script src="index.js"></script>
	<script>
		var sudoku;

		function postForm() 
		{
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
						"valid" : true
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
						console.log(this.responseText);
				        return false;
				    }

				    console.log(sudoku);
				    return true;
				}
			};

			xmlHttp.open("POST","process.php",true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			xmlHttp.send(queryString);
			
		}
	</script>
</body>
</html>