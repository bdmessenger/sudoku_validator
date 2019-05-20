const range = (start, end) => {
    const length = end - start;
    return Array.from({ length }, (_, i) => start + i);
}

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

function find_duplicate_in_array(array) {
	const object = {};
	const result = [];

	array.forEach(item => {
		if(!object[item])
			object[item] = 0;
		object[item] += 1;
	});

	for(const prop in object){
		if(object[prop] >= 2){
			result.push(prop);
		}
	}
	
	if(result.length == 0){
		return false;
	} else {
		return result;
	}
}

var validate = function(arrays, mode = 0)
{
	var validation = true;
	for(var i = 0; i < 9; i++)
	{
		const container = [[],[]];
		const indexes = [[],[]];
		for(var s = i; s < 81;s += 9)
		{
			container[0].push(parseInt(arrays[s].value));
			indexes[0].push(s);
		}

		for(var b of range(i * 9, ((i + 1) * 9)))
		{
			container[1].push(parseInt(arrays[b].value));
			indexes[1].push(b);
		}

		const find_duplicate_result = find_duplicate_in_array(container[mode]);

		console.log(find_duplicate_result)

		if(find_duplicate_result !== false)
		{
			for(const index in find_duplicate_result)
			{
				var number = find_duplicate_result[index];
				for(const key in container[mode])
				{
					if(container[mode][key] == number)
					{
						arrays[indexes[mode][key]].valid = false;
						validation = false;
					}
				}
			}
		}
	} return validation;
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

// var clearBoard = function()
// {
// 	ctx.clearRect(0, 0, 500, 500);
// }