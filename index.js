
function auto_fill_boxes()
{
	var example = [
		[3,5,2,9,1,8,6,7,4],
		[8,9,7,2,4,6,5,1,3],
		[6,4,1,7,5,3,2,8,9],
		[7,8,3,5,6,9,4,2,1],
		[9,2,6,1,3,4,7,5,8],
		[4,1,5,8,2,7,9,3,6],
		[1,6,4,3,7,5,8,9,2],
		[2,7,8,4,9,1,3,6,5],
		[5,3,9,6,8,2,1,4,7]
	];

	var inputArray = document.querySelectorAll('#cell_input');
	
	var key = 0;
	for(var i = 0; i < 9; i++)
	{
		for(var index = 0; index < 9; index++)
		{
			var temp = example[i];
			if(inputArray[index].type = 'text')
			{
				inputArray[key].value = temp[index];
				key++;
			}
		}
	}
}


var canvas;
var ctx;

if(document.getElementById("sudoku"))
{
	canvas = document.getElementById("sudoku");
	ctx = canvas.getContext("2d");
}


function sudoku_board(){
	ctx.beginPath();
	ctx.lineWidth = 2;
	for(var i = 25; i < 450;i += 50)
	{
		ctx.rect(i, 25, 50, 50);
		ctx.rect(i, 75, 50, 50);
		ctx.rect(i, 125, 50, 50);
		ctx.rect(i, 175, 50, 50);
		ctx.rect(i, 225, 50, 50);
		ctx.rect(i, 275, 50, 50);
		ctx.rect(i, 325, 50, 50);
		ctx.rect(i, 375, 50, 50);
		ctx.rect(i, 425, 50, 50);
	}

	ctx.rect(25, 25, 450, 450);
	ctx.strokeStyle = "#000000";
	ctx.stroke();

	ctx.beginPath();
	ctx.lineWidth = 4;
	ctx.strokeStyle = "#FF0000";


	ctx.moveTo(175, 25);
	ctx.lineTo(175, 475);
	ctx.moveTo(325, 25);
	ctx.lineTo(325, 475);

	ctx.moveTo(25, 175);
	ctx.lineTo(475, 175);
	ctx.moveTo(25, 325);
	ctx.lineTo(475, 325);

	ctx.stroke();
}

var fillBoard = function(sudoku)
{
	ctx.clearRect(0, 0, 500, 500);
	ctx.beginPath();
	ctx.font = "32px Arial";

	for(const index in sudoku.data){
		var data = sudoku.data[index];
		ctx.beginPath();
		ctx.fillStyle = "#000000";
		ctx.fillText(data.value,data.position.x,data.position.y);
	}
	sudoku_board();
}

var fillBoardWithMissingCells = function(sudoku)
{
	ctx.clearRect(0, 0, 500, 500);
	ctx.beginPath();
	ctx.font = "32px Arial";

	var data = sudoku[0].concat(sudoku[1],sudoku[2],sudoku[3],sudoku[4],sudoku[5],sudoku[6],sudoku[7],sudoku[8]);

	for(const index in data){
		ctx.beginPath();
		ctx.fillStyle = "#000000";
		ctx.fillText(data[index].value,data[index].position.x,data[index].position.y);
	}
	sudoku_board();
}

function markAllCellsValid()
{
	var queryArray = document.querySelectorAll(".item");

	for(const i in queryArray)
	{
		if(i < 81) queryArray[i].style.background = "rgba(121, 244, 112, 0.4)";
	}

	return true;
}

function markErrors(errors)
{
	clearErrorMarkings();
	markAllCellsValid();
	//console.log(errors);
	var error_log = [];

	for(const i in errors)
	{
		var parent = document.querySelector("div.item input[name='"+errors[i].name+"']").parentNode;
		parent.style.background =  "rgba(221, 33, 33, 0.4)";
		error_log.push(errors[i]);
	}

	return error_log;
}

function clearErrorMarkings()
{
	var sudoku = document.querySelectorAll(".item");
	for(var i = 0; i < 81; i++)
	{
		sudoku[i].style.background = "rgba(255, 213, 70, 0.4)";
	}
}

function removeCellsByRandom(sudoku, mode = 'normal')
{
	var squares = rearrangeInSquares(sudoku);
	var normal = [4,3,6,3,4,3,6,3,4];
	var hard = [3,4,2,4,1,4,2,4,3];


	for(var k = 0; k < 9; k++)
	{
		for(var i = 0; i < (9 - (eval(mode)[k]) ); i++)
		{
			var rand_int = Math.floor(Math.random() * squares[k].length);
			squares[k].splice(rand_int,1);
		}
	}

	return squares;
}


function rearrangeInSquares(sudoku)
{
	var columns = getByColumns(sudoku);
	var counter = 0;
	var cell_groups = [
		[],[],[],[],[],[],[],[],[]
	];

	for(var k = 0; k < 9; k++)
	{
		while(cell_groups[k].length != 9)
		{
			for(var i = counter; i < (counter + 3); i++)
			{
				cell_groups[k].push(columns[i].shift());
			}
		}

		if(columns[0].length == 0)
		{
			for(var y=0;y<3;y++)columns.shift();
		}
	}
	return cell_groups;
}


function getByColumns(sudoku)
{
	var data = sudoku.data;
	var cell_groups = [];

	for(var i = 1; i < 10; i++)
	{
		var array = [];
		for(const index in data)
		{
			if(data[index].name.includes("slot_" + i))
			{
				array.push(data[index]);
			}
		}

		cell_groups.push(array);
	}

	return cell_groups;
}

function getByRows(sudoku)
{
	var data = sudoku.data;
	var cell_groups = [];

	for(var i = 1; i < 10; i++)
	{
		var array = [];
		for(const index in data)
		{
			if(data[index].name.includes("row_" + i))
			{
				array.push(data[index]);
			}
		}

		cell_groups.push(array);
	}

	return cell_groups;

}
