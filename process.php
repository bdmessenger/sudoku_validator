<?php

//var_dump($_POST['form']);

if(isset($_POST['form']))
{
	$dataObject = [];
	$output = '{ "errors": {"data": ';

	$errors = [];

	for ($index = 0; $index < 81; $index++) 
	{ 
		//$output .= $_POST['form'][$index];
		$json_array = json_decode($_POST['form'][$index],true);
		array_push($dataObject, $json_array);

		$value = $json_array['value'];

		if($value !== 0 && !isset($value) || $value !== 0 && empty($value) && $value == "")
		{
			$errors[$json_array['name']] = 'Missing value(s). Please check all input fields in search for errors.';
		} elseif (!is_numeric($value) || $value == 0) {
			$errors[$json_array['name']] = 'Invalid digit(s). Please check all input fields in search for errors.';
		}
	}

	if(count($errors) > 0)
	{
		$elements = count($errors);
		$counter = $elements;
		$object_string = '';

		foreach ($errors as $name => $message) {
			$object_string .= '{ "name": "' . $name .'", "message": "' . $message . '"}';

			if($elements > 1 && $counter != 1)
			{
				$object_string .= ',';
				$counter--;
			}
		}
		if($elements > 1)$output .= '[' . $object_string . ']}}';
		else $output .= $object_string . '}}';

		echo $output;
		return;
	}


	// array_merge(validateSudoku(getValuesOnly($dataObject)), $errors);

	if (sizeof(validateSudoku(getValuesOnly($dataObject))) > 0)
	{
		$errors = validateSudoku(getValuesOnly($dataObject));

		for ($i = 0; $i < 81 ; $i++) 
		{
			if(!in_array($i, $errors))
			{
				$dataObject[$i]['valid'] = true;
			}
		}

		$errors = [];

		//var_dump($dataObject);

		foreach ($dataObject as $array) {
			//var_dump($array['valid']);
			if($array['valid'] == false)
			{
				array_push($errors, $array);
			}
		}

		if(sizeof($errors) > 0)
		{
			$invalid_cells = [];
			$string = "";
			foreach ($errors as $key => $array) {
				$invalid_cells[] = $array;
				$string .= json_encode($array);
				if((sizeof($errors) - 1) != $key){
					$string .= ',';
				}
			}

			if(sizeof($errors) > 1) $output .= '[' . $string . ']';

			$output .= ', "message": "The following cells are invalid: ';
			foreach ($invalid_cells as $key => $cell) {
				$output .= $cell['value'] . ' (' . $cell['name'] . ')';
				if( (sizeof($invalid_cells) - 1) != $key ){ $output .= ', ';}
			}
			$output .= '."}}';
		}
		
	} else {
		$output .= 'false}}';
	}

	
	echo $output;
	return;
}


function validateSudoku($array)
{
	return array_unique(array_merge(validateRows($array),validateColumns($array)));
}

function validateRows($array)
{
	$errors = [];
	$index = 0;

	while($index < 81)
	{
		$container = [];

		for($i = $index; $i < ($index + 9); $i++)$container[$i] = $array[$i];

		foreach(find_duplicate_in_array($container) as $val)
	 	{
	 		$errors = array_merge(getKeysByValue($container,$val),$errors);
	 	}

	 	$index += 9;
	}
	return $errors;
}

function validateColumns($array)
{
	$errors = [];
	$index = 0;

	while($index < 9)
	{
		$container = [];

		for($i = $index; $i < 81; $i += 9)$container[$i] = $array[$i];

		foreach(find_duplicate_in_array($container) as $val)
	 	{
	 		$errors = array_merge(getKeysByValue($container,$val),$errors);
	 	}

	 	$index++;
	}
	return $errors;
}


function find_duplicate_in_array($array)
{
	$object = array();
	foreach (array_count_values($array) as $val => $c) {
		if($c > 1) $object[] = $val;
	}
	return $object;
}

function getKeysByValue($array,$value)
{
	$container = [];
	foreach(array_keys($array,$value) as $key)$container[] = $key;

	return $container;
}

function getValuesOnly($array)
{
	$container = [];
	foreach ($array as $key => $value) {
		$container[$key] = $array[$key]['value'];
	}

	return $container;
}
