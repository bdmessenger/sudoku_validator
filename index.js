
var sudoku = [
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
	
	if(result === undefined || result.length == 0){
		return false;
	} else {
		return result;
	}
}

var validate = function(arrays)
{
	const result = [];
	for(var i = 0; i < 9; i++)
	{
		const container = [];
		for(const arr in arrays)
		{
			container.push(arrays[arr][i]);
		}

		const find_duplicate_result = find_duplicate_in_array(container);

		if(find_duplicate_result !== false)
		{
			result.push(find_duplicate_result);
		}
		
	}


	console.log('Validation is ');

	if(result === undefined || result.length == 0)
	{
		return true;
	} else {
		return false;
	}
};

//console.log(validate(sudoku));

var canvas = document.getElementById("sudoku");
var ctx = canvas.getContext("2d");

ctx.beginPath();

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