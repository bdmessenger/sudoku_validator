<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method='post' action="results.php">
		<div id="sudoku_board">
			<?php 
			for($count = 0; $count < 3; $count++){
				for($num = 1; $num <= 3; $num++)
				{
					for($i = 0;$i < 9;$i++){ ?>
						<input type="text" name="<?php echo 'column_'.($count + 1).'_row_'.$num.'_slot_'.($i + 1); ?>" size="1" maxlength="1">
						<?php if($i == 2 || $i == 5)
						{
							echo '|';
					 	} 
					} echo '</br>';
				} if($count != 2){
					echo '------------------|||------------------|||------------------</br>';
				}
			}
			?>
			<input type="submit" name="submit">
		</div>
	</form>
	</br></br>
	<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;"></canvas>


	<script src="index.js"></script>
</body>
</html>