<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	if(isset($_SESSION['error_message']))
	{
		echo $_SESSION['error_message'];
		//unset($_SESSION['error_message']);
	}
	//var_dump($_COOKIE['results']);
	?>
	<form id="myForm" method='post' action="process.php">
		<?php require 'input_board.php'; ?>
	</form>
	<button onclick="postForm()">Submit</button>
	<button onclick="auto_fill_boxes()">Auto</button>
	</br></br>
	<div id="results_board" style="text-align: center;display: inline-block;">
		<h3 id="status"></h3>
		<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;" hidden="true"></canvas>
	</div>
	<script src="index.js"></script>
	<script>
		function postForm()
		{
			var sudoku = [];
			document.getElementById("sudoku").hidden = false;
			var form = document.querySelectorAll("#sudoku_input_board input");
			
			var index = 0;
			var y_counter = 60;
			while(index != 81)
			{
				for(var i = 40; i < 450; i += 50)
				{
					var item = form[index];
					sudoku.push({
						"name" : item.name,
						"value" : item.value,
						"position" : {x: i, y: y_counter},
						"valid" : true
					});
					index++;
				}

				y_counter += 50;
			}
			//console.log(parseInt(sudoku[0].value));
			var results = validate(sudoku) || validate(sudoku,1);
			document.querySelector("#status").innerHTML = "Validation is " + results;
			fillBoard(sudoku);
			return false;
		}

	</script>
</body>
</html>
<?php session_destroy(); ?>