<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$data_file = "data.txt";
$palindromes_file = "palindromes.txt";

$error = $echo_data_file = $echo_palindromes_file = "";
$palindromes_array = array();

if ($_POST) {

	if (isset($_POST['insert_record'])) {
		$record = trim($_POST['input_record']);
		
		if ($record) {
		
			if (is_numeric($record)) {
				$data_file_string = file_get_contents($data_file);
				
				if (strlen($data_file_string) > 0) {
					file_put_contents($data_file, $data_file_string." ".$record);
				} else {
					file_put_contents($data_file, $record);
				}
			} else {
				$error = "Only numbers are allowed.";
			}
			
		} else {
			$error = "Please enter a number.";
		}
		
	}
	
	if (isset($_POST['filter_data'])) {
		$data_file_string = file_get_contents($data_file);
		$data_file_array = explode(" ", $data_file_string);
		
		foreach ($data_file_array as $number) {
		
			if ($number == strrev($number)) {
				$palindromes_array[] = $number;
			}
		}
		
		$palindromes_file_string = $echo_palindromes_file = implode(" ", $palindromes_array);
		file_put_contents($palindromes_file, $palindromes_file_string);
	}
	
	if (isset($_POST['erase_data'])) {
		file_put_contents($data_file, "");
		file_put_contents($palindromes_file, "");
	}
}

$echo_data_file = file_get_contents($data_file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
	
    <title>Palindrome</title>
	
	<link rel="stylesheet" href="//storage.googleapis.com/code.getmdl.io/1.0.5/material.indigo-pink.min.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
	
    <style>
		.container { max-width: 600px; margin:0px auto; text-align: center; }
		.mdl-textfield__input, .mdl-textfield__label { font-size:3rem; padding:2% 0; text-align:center }
		input[type='number'] { -moz-appearance:textfield }
		input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance:none }
        .error { color:darkred }
    </style>
</head>
<body>
	<div class="mdl-layout__container mdl-color--grey-100">
		<div class="mdl-layout mdl-js-layout container">
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--12-col">
					<h1>Palindrome</h2>
					
					<form method="POST">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="input_record" autocomplete="off" />
							<label class="mdl-textfield__label" for="sample4">Number...</label>
							<span class="mdl-textfield__error">Input is not a number.</span>
						</div>
						
						<p class="error"><?=$error?></p>
						
						<div class="buttons">
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" name="insert_record">Insert</button>
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" name="filter_data">Filter</button>
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" name="erase_data">Erase All Data</button>
						</div>
					</form>
					
							
					<div class="results">
						<p><?=strlen($echo_data_file) > 0 ? "<b>Data.txt</b>: ".$echo_data_file : ""?></p>
						<p><?=strlen($echo_palindromes_file) > 0 ? "<b>Palindromes.txt</b>: ".$echo_palindromes_file : ""?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="//storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
</body>
</html>