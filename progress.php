<?php
	session_start();
	$name = $_SESSION["name"];
	//$password=$_SESSION["password"];
	$pFilename = "user/pb_".$name."_json.sj";

	//get the user json file
	$json = file_get_contents($pFilename);

	// parse data
	$userInfo = json_decode($json, true);
	$nickname = $userInfo['nickname']; // a string
	$tasks = $userInfo['tasks']; // a list of tasks
	$groups = $userInfo['groups']; // a list of groups this user is in

	// $pCount=count($pTodo);
	// $gCount=count($gTodo);
	// $sCount=$pCount+$gCount;
	
	//print($gCount);
	//print($pCount);

	include("common.php");
	top();
?>
		<div id="main">  
			<!-- user's personal todo list 0v0 -->
			<h2><?=$nickname?>'s To-Do List</h2>
			<ul id="todolist">
            	<?php
            	$index = 0;
				foreach ($tasks as $task) {
					if ($task['complete'] == "uc") {
				?>
                    <li>
                        <form action = "submit.php" method = "post">
                            <input type = "hidden" name = "type" value = "user" />
                            <input type = "hidden" name = "action" value = "complete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Complete" />
                        </form>
                        <form action = "submit.php" method = "post">
                        	<input type = "hidden" name = "type" value = "user" />
                        	<input type = "hidden" name = "action" value = "delete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Delete" />
                        </form>
                        <?=$task['task_name']?>
                    </li>		
				<?php 
					}
					$index++;
				}
				?>
				
				<!--add-->
				<li>
					<form action = "submit.php" method = "post">
						<input type = "hidden" name = "type" value = "user" />
						<input type = "hidden" name = "action" value = "add" />
						<input name= "item" type="text" size="25" autofocus="autofocus" />
						<input type= "submit" value="Add" />
					</form>
				</li>
			</ul>  
        	
        	<!--user's groups' todo list 0^0-->
        	<?php
				foreach ($groups as $group) { // $group is a string of group name
					// find the group data
					$gFilename = "group/pb_".$group."_json.sj";
					$gJson = file_get_contents($gFilename);
					$gInfo = json_decode($gJson, true);

					// parse group data
					$gNickname = $gInfo['nickname'];
					$gTasks = $gInfo['tasks'];

					// display data
			?>
					<h2><?= $gNickname	 ?>'s To-Do List</h2>
					<ul id="todolist">
			<?php
					$index = 0;
					foreach ($gTasks as $task) {
					if ($task['complete'] == "uc") {
			?>
                    <li>
                        <form action = "submit.php" method = "post">
                            <input type = "hidden" name = "type" value = "group" />
                            <input type = "hidden" name = "group_name" value = "<?= $group ?>" />
                            <input type = "hidden" name = "action" value = "complete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Complete" />
                        </form>
                        <form action = "submit.php" method = "post">
                        	<input type = "hidden" name = "type" value = "group" />
                        	<input type = "hidden" name = "group_name" value = "<?= $group ?>" />
                        	<input type = "hidden" name = "action" value = "delete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Delete" />
                        </form>
                        <?=$task["task_name"]?>
                    </li>		
				<?php 
					}
					$index++;
					}
				?>
					<!--add for group-->
					<li>
						<form action = "submit.php" method = "post">
							<input type = "hidden" name = "type" value = "group" />
							<input type = "hidden" name = "action" value = "add" />
							<input type = "hidden", name = "group_name" value = "<?= $group ?>" />
							<input type="text" name="item" size="25" autofocus="autofocus" />
							<input type="submit" value="Add" />
						</form>
					</li>
					</ul> 

				<?php
				}
			?>

			<!-- competed task for user-->
			<h2><?=$nickname?> has completed these: </h2>
            
            <ul id="comList">
            	<?php
				foreach ($tasks as $task) {
					if ($task['complete'] == "c") {
				?>
                    <li>
                        <?=$task['task_name']?>
                    </li>		
				<?php 
					}
				}
				?>
			</ul>

			<!-- competed task for groups-->
			<?php
				foreach ($groups as $group) { // $group is a string of group name
					// find the group data
					$gFilename = "group/pb_".$group."_json.sj";
					$gJson = file_get_contents($gFilename);
					$gInfo = json_decode($gJson, true);

					// parse group data
					$gNickname = $gInfo['nickname'];
					$gTasks = $gInfo['tasks'];

					// display data
			?>
			<h2><?=$gNickname?> has completed these: </h2>
			<ul id="comList">
            	<?php
				foreach ($gTasks as $task) {
					if ($task['complete'] == "c") {
				?>
                    <li>
                        <?=$task['task_name']?>
                    </li>		
				<?php 
					}
				}
			}
			?>			
			</ul>       

		</div>

<?php
	bottom();
?>