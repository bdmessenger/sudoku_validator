# Sudoku Validator

The code (consists of html, php and javascript) is used to validate whether the sudoku rows/columns' cells are acceptable before converting into a HTML Canvas.
When validating the data, it will search for missing or invalid digits (Between 1 to 9 only), and then looks for repetition of digits from every row / column.

The error will present a message and turn a data cellbox's color to red. If there are no errors presented, the validation header will return with a value of true, and also reveals a button below the board to let you pass off the input fields to another page that will insert the data in the HTML canvas.

In the result page, there are four buttons to click on. The two middle buttons are used to remove some random digits from each 3x3 square of the canvas in order to create an open puzzle for anyone to figure out. The last button on the right will let you print out the Sudoku puzzle only.
The very first button will let you regain the original digits that were removed from the puzzle after you pressed on either of the middle buttons.

Check it out:
https://www.brant.work/projects/sudoku_validator
