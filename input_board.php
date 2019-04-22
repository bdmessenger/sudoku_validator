<div id="sudoku_input_board">
			<?php 
			for($row = 1; $row < 10; $row++)
			{
				for($slot = 1; $slot < 10; $slot++)
				{
					echo '<input type="text" name="row_'.$row.'_slot_'.$slot.'" size="1" maxlength="1">';
					if($slot == 3 || $slot == 6){echo ' ||| ';}
				}
				echo '</br>';

				if($row == 3 || $row == 6){ echo '-----------------|||------------------|||------------------</br>'; }
			}
			
			?>
</div>