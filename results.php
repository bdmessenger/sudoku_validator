<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['sudoku']))
	{
		?> <script><?php
		echo 'sudoku_board();';
		echo 'ctx.beginPath();
		ctx.font = "32px Arial";';
		$sudoku = $_SESSION['sudoku'];
		$y_counter = 60;

		foreach($sudoku as $row)
		{
			$index = 0;
			for($i = 40;$i < 450;$i += 50)
			{
				echo 'ctx.fillText("'.$row[$index].'", '.$i.', '.$y_counter.');';
				$index++;
			}

			$y_counter += 50;
		}

		?></script><?php
	}
	?>
</body>
</html>