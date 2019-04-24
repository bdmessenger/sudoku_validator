<?php

//var_dump($_POST['form']);

if(isset($_POST['form']))
{

	$dataArray = [];

	$string = '[';

	//var_dump(intval(json_decode($string[0])->value));

	for ($index = 0; $index < 81; $index++) 
	{ 
		$string .= $_POST['form'][$index];
		$json_array = json_decode($_POST['form'][$index],true);
		array_push($dataArray, $json_array['value']);

		if(!isset($dataArray[$index]) || empty($dataArray[$index]) && $dataArray[$index] == "")
		{
			echo 'Missing value(s). Please check all input fields in search for errors.';
			return;
		} elseif (!is_numeric($dataArray[$index]) || $dataArray[$index] == 0) {
			echo 'Invalid digit. Please check all input fields in search for errors.';
			return;
		}

		if($index < 80)$string .= ',';
	}

	$string .= ']';
	//echo $string;



	return;
}


function validate(array)
{
	$
}


function find_duplicate_in_array($array)
{
	$object = array();
	foreach (array_count_values($array) as $val => $c) {
		if($c > 1) $object[] = $val;
	}

	var_dump($object);
}