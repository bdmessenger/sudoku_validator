<?php

if(isset($_POST['submit']))
{
	$counter = 0;
	$sudoku = 
	[
		[],[],[],[],[],[],[],[],[]
	];
	for($column = 1;$column < 4;$column++)
	{
		for($row = 1; $row < 4; $row++)
		{
			for($slot = 1; $slot < 10;$slot++)
			{
				$temp_name = 'column_'.$column.'_row_'.$row.'_slot_'.$slot;
				if(!isset($_POST[$temp_name]))
				{
					echo 'Missing value. Please check all boxes for correction.';
					return;
				} elseif (!is_numeric($_POST[$temp_name])) {
					echo 'Invalid digit. Please check all boxes for correction.';
					return;
				} else {
					array_push($sudoku[$counter],$_POST[$temp_name]);
				}
			}
			$counter++;
		}
	}
	
}