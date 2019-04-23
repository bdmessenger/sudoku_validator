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



	<script>
		function postForm() 
		{
			var sudoku = [];
			var form = document.querySelectorAll("#cell_input");

			// var index = 0;
			// var y_counter = 60;
			// while(index != 81)
			// {
			// 	for(var i = 40; i < 450; i += 50)
			// 	{
			// 		var item = form[index];
			// 		sudoku.push({
			// 			"name" : item.name,
			// 			"value" : item.value,
			// 			"position" : {x: i, y: y_counter},
			// 			"valid" : true
			// 		});
			// 		index++;
			// 	}

			// 	y_counter += 50;
			// }
			
		}
	</script>
</body>
</html>