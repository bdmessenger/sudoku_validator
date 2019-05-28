<?php
session_start();

if(isset($_SESSION['data']))
{

	?>

	<html>
	<head>
		<style type="text/css">
			@media print {
				h3, h5, button {
					display: none;
				}
 			}
		</style>
	</head>
	<body>
		<div style="margin: 0 auto;text-align:center;">
			<h3>Sudoku Puzzle Completed!</h3>
			<h5>*Click below the canvas to setup a incompleted puzzle. You can also print the puzzle out.* </h5>
			<input id="data" type="hidden" value='<?php echo $_SESSION['data'];?>'>
			<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;"></canvas>
			<br>
			<button onclick="fillBoard(data)">Reset</button>
			<button onclick="fillBoardWithMissingCells(removeCellsByRandom(data))">Normal</button>
			<button onclick="fillBoardWithMissingCells(removeCellsByRandom(data, 'hard'))">Hard</button>
			<button onclick="print()">Print</button>
		</div>

		<script type="text/javascript" src="index.js"></script>
		<script type="text/javascript">
			var data = JSON.parse(document.querySelector("#data").value);

			fillBoard(data);

		</script>
	</body>
	</html>
	<?php
} ?>