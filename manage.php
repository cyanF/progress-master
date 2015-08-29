<?php
	session_start();
	$name = $_SESSION["name"];

	$action = $_POST["action"]; // action should be "add" or "edit"
	$title = $_POST["title"];
	$type = $_POST["type"]; // type should be "user" or "group"
	include("common.php");
	top();

	getAllUser($users);
	var_dump($users);


	if($action == "add"){ ?>
		<h2><?= $action ?> a task</h2>
		<form action = "submit.php" method = "post">
			<input type = "hidden" name = "type" value = "<?= $type ?>" />
			<?php if($type == "group") { // if type is group, add group_name
			 ?>
			<input type = "hidden", name = "group_name" value = "<?= $_POST['group_name'] ?>" />
			<?php } ?>
			<input type = "hidden" name = "action" value = <?= $action ?> />
			Task Title: <input type = "text", name = "title" size = "25" value = "<?= $title ?>"/> <br />
			Task Description: <textarea rows = "4" cols = "50" name="task_description" autofocus="autofocus" placeholder="Enter task description here"></textarea> <br />
			
			Collaborator:
			<select multiple>
			    <option value='' disabled selected style='display:none;'>Please Choose User</option>
			    <option value='0'>Open when</option>
			    <option value='1'>Closed when</option>
			</select> 
			<select>
			    <option value='' disabled selected style='display:none;'>Please Choose Group</option>
			    <option value='0'>Open when powered</option>
			    <option value='1'>Closed when powered</option>
			</select> </br>

			Due date: <input type = "datetime-local" name = "due_date" value="">
			<input type="submit" value = "Save"/>
		</form>
<?php
	}
?>


<?php	
	bottom();

	// this functino search for /user folder and get all users parse out
	// using the form: <username> => <nickname>
	// and stores it in $users
	function getAllUser(&$users){ // pass by reference
		// read files in "/user"
		$dir = "user";
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
			if (substr($filename, 0, 3) == "pb_"){ // check it is the file we want
				$files[] = "user/".$filename;
			}
		}

		// parse data
		foreach ($files as $file) {
			$json = file_get_contents($file);
			$data = json_decode($json, true);
			$users[$data['username']] = $data['nickname'];
		}
	}

	// same as getAllUser function except it search for all groups
	function getAllGroup(&$groups){
		// read files in "/user"
		$dir = "/group";
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
			if (substr($filename, 0, 3) == "pb_"){ // check it is the file we want
				$files[] = "group/".$filename;
			}
		}

		// parse data
		foreach ($files as $file) {
			$json = file_get_contents($file);
			$data = json_decode($json, true);
			$users[$data['name']] = $data['nickname'];
		}
	}

	function getSelectedUser(){

	}

	function getSelectoedGroup(){

	}

	// type should be user or group
	function displayCollaboratorInAdd($collaborators, $type){ ?>
		<select>
		<?php
		foreach($collaborators as $collaborator){
			
		}
	}
?>