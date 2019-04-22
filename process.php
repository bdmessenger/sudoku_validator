<?php

session_start();

if(isset($_POST['submit']))
{

	$index = 0;
	$sudoku = 
	[
		[],[],[],[],[],[],[],[],[]
	];
	
	for($row = 1; $row < 10; $row++)
	{
		for($slot = 1; $slot < 10; $slot++)
		{
			$temp_name = 'row_'.$row.'_slot_'.$slot;
			if(!isset($_POST[$temp_name]) || empty($_POST[$temp_name]) && $_POST[$temp_name] != 0)
			{
				$_SESSION['error_message'] = 'Missing value. Please check all boxes for correction.';
				header('Location: index.php');
				exit();
			} elseif (!is_numeric($_POST[$temp_name]) || $_POST[$temp_name] == 0) {
				$_SESSION['error_message'] = 'Invalid digit. Please check all boxes for correction.';
				header('Location: index.php');
				exit();
			} else {
				array_push($sudoku[$index],$_POST[$temp_name]);
			}
		}
		$index++;
	}

	//$_SESSION['sudoku'] = $sudoku;
}?>

<!DOCTYPE html>
<html>
	<body>
		<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;"></canvas>
		<script src="index.js"></script>
		<script>
			var results = validate(<?php echo json_encode($sudoku); ?>);
			if (results.length == 0)
			{
				console.log("length is zero?");
				// <?php //header('Location: results.php');
				// exit(); ?>

			}

			for (const index in results)
			{
				console.log(results[index]);
			}

			sudoku_board();
			fillBoard(<?php echo json_encode($sudoku); ?>);

		</script>
	</body>
</html>