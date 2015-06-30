<?php
	session_start();
	$name = $_SESSION["name"];

	$action = $_POST["action"]; // action should be "add" or "edit"
	$title = $_POST["item"];
	$type = $_POST["type"]; // type should be "user" or "group"

	include("common.php");
	top();
?>

<h2><?= $action ?> a task</h2>
<form action = "submit.php" method = "post">
	<input type = "hidden" name = "type" value = "<?= $type ?>" />
	<?php if($type == "group") { // if type is group, add group_name
	 ?>
	 <input type = "hidden", name = "group_name" value = "<?= $_POST['group_name'] ?>" />
	<?php } ?>
	<input type = "hidden" name = "action" value = <?= $action ?> />
	Task Title: <input type = "text", name = "title" size = "25" value = "<?= $title ?>"/> <br />
	Task Description: <textarea rows = "4" cols = "50" name="test_description" autofocus="autofocus" placeholder="Enter task description here"></textarea> <br />
	Due date: <input type = "datetime-local" name = "due_date" value="">
	<input type="submit" value = "Save"/>
</form> 


<?php	
	bottom();
?>