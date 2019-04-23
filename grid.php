<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="sudoku">
		<h3 id="status" style="text-align: center;">Validation:</h3>
  		<?php for($i = 1; $i < 10; $i++) {
  			echo '<div class="wrapper">
				<div class="one">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_1" size="1" maxlength="1">
				</div>
				<div class="two">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_2" size="1" maxlength="1">
				</div>
				<div class="three">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_3" size="1" maxlength="1">
				</div>
				<div class="four">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_4" size="1" maxlength="1">
				</div>
				<div class="five">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_5" size="1" maxlength="1">
				</div>
				<div class="six">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_6" size="1" maxlength="1">
				</div>
				<div class="seven">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_7" size="1" maxlength="1">
				</div>
				<div class="eight">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_8" size="1" maxlength="1">
				</div>
				<div class="nine">
					<input type="text" id="cell_input"  name="row_'.$i.'_slot_9" size="1" maxlength="1">
				</div>
			</div></br></br></br>';
		} ?>
    	<div class="vl1"></div>
    	<div class="vl2"></div>
    	<div class="hl1"></div>
    	<div class="hl2"></div>
    	<button onclick="postForm()">Submit</button>
<!-- 		<canvas id="sudoku" width="500" height="500" style="border:1px solid #d3d3d3;"></canvas> -->
	</div>
	<script src="index.js"></script>
	<script>
		function postForm()
		{
			//var sudoku = [];
			var form = document.querySelectorAll("#cell_input");
			//var cell = document.querySelectorAll("input[name=row_1_slot_1]<.one");
			if(form[0].value != 5)
			{
				form[0].parentElement.style.backgroundColor = "rgba(0, 0, 0,.5)";
			} else {
				form[0].parentElement.style.backgroundColor = "";
			}
			//console.log(form[0].parentElement.style);
		}
	</script>
</body>
</html>