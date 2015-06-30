<?php
	session_start();

	$action = $_POST["action"];
	$type = $_POST["type"];

	// check if the action is for user or for a group
	if($type == "user"){
		$name = $_SESSION["name"];
	}else{
		$name = $_POST["group_name"];
	}

	$filename = $type."/pb_".$name."_json.sj";
	$json = file_get_contents($filename);

	$data = json_decode($json, true);
	$tasks = $data['tasks']; // array of tasks

	// act
	if($action == "complete" || $action == "delete"){
		$status = substr($action, 0, 1); // get the goal status of the task
		$index = $_POST["index"];
		$tasks[$index]['complete'] = $status;
		$data['tasks'] = $tasks;
		file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
	}else if($action == "add"){
		$taskToAdd = array(
			"task_name" => $_POST["title"],
			"task_description" => $_POST["task_description"],
      		"complete" => "uc",
      		"collaborator" => array(
      			"group" => array("control"),
      			"user" => array("")
      		),
      		"due_date" => $_POST["due_date"],
      		"task_color" => "default"
		);
		array_push($tasks, $taskToAdd);
		$data['tasks'] = $tasks;
		file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
	}else{
		echo "invalid action";
	}

	header("Location: progress.php");







	// $action = explode("_",$actionString);
	// if ($action[0] == "group") {
	// 	$name = "group";
	// } else {
	// 	$name=$_SESSION["name"];	
	// }

	// $filename="pb_".$name.".sj";

	// if ($action[1] == "complete") {
	// 	$index=$_POST["index"];
	// 	$i=0;
	// 	$filename="pb_".$name.".sj";	
	// 	$orifile=file($filename);
	// 	$newfile=array();
	// 	foreach ($orifile as $item) {
	// 		if ($i != $index ) {
	// 			array_push($newfile,$item."\n");	
	// 			# echo("keep_".$i);
	// 		} else {
	// 			$newItem= explode("|",$item);
	// 			$newItem[1]="c";
	// 			$item=$newItem[0]."|".$newItem[1];
	// 			array_push($newfile,$item."\n");
	// 			#echo("change_".$i);
	// 		}
	// 		$i++;
	// 	}
	// 	#print_r($newfile);
	// 	file_put_contents($filename,$newfile);
	// 	#echo("complete");
	// } else {
	// 	$item=$_POST["item"];
	// 	file_put_contents($filename,$item."|uc\n",FILE_APPEND);
	// 	# echo("add");
	// }
	// 	header("Location: progress.php");
?>