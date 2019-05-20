<?php

$data = $_POST['data'];
//var_dump($data);
?>

<html>
<body>
	<?php echo '<input id="data" type="hidden" value='.$data.'>'; ?>
	<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;"></canvas>
	<script type="text/javascript" src="index.js"></script>
	<script type="text/javascript">
		var data = JSON.parse(document.querySelector('#data').value);
		//console.log(document.querySelector('#data'));
		fillBoard(data);
	</script>
</body>
</html>