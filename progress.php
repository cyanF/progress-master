<?php
	session_start();
	$name = $_SESSION["name"];
		
	// when session times out or due to other reason,
	// name cannot be retrieved, jump back to main page.
	if($name == ""){
		header("Location: index.php");
	}

	$pFilename = "user/pb_".$name."_json.sj";

	//get the user json file
	$json = file_get_contents($pFilename);

	// parse data
	$userInfo = json_decode($json, true);
	$nickname = $userInfo['nickname']; // a string
	$tasks = $userInfo['tasks']; // a list of tasks
	$groups = $userInfo['groups']; // a list of groups this user is in

	include("common.php");
	top();
?>
		<div id="main">  
			<!-- user's personal todo list 0v0 -->
			<?php displayUTasks($tasks, $nickname, "user"); ?>

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
					displayUTasks($gTasks, $gNickname, "group", $group);
				}
			?>
					

			<!-- competed task for user-->
			<?php 
				displayCTasks($tasks, $nickname);
			?>
			
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
					displayCTasks($gTasks, $gNickname);
				}
			?>       
		</div>

<?php
	bottom();

	// display uncomplete tasks
	function displayUTasks($tasks, $name, $type, $group_name = ""){ ?>
		<h2><?=$name?>'s To-Do List</h2>
			<ul id="todolist">
            	<?php
            	$index = 0;
				foreach ($tasks as $task) {
					if ($task['complete'] == "uc") {
						// get the due date, represents as second since 1970.1.1
						$date_due = strtotime($task['due_date']);
				?>
                    <li>
                        <form action = "submit.php" method = "post">
                            <input type = "hidden" name = "type" value = "<?= $type ?>" />
                            <input type = "hidden" name = "group_name" value = "<?= $group_name ?>" />
                            <input type = "hidden" name = "action" value = "complete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Complete" />
                        </form>
                        <form action = "submit.php" method = "post">
                        	<input type = "hidden" name = "type" value = "<?= $type ?>" />
                        	<input type = "hidden" name = "group_name" value = "<?= $group_name ?>" />
                        	<input type = "hidden" name = "action" value = "delete" />
                            <input type = "hidden" name = "index" value = "<?= $index ?>" />
                            <input type = "submit" value = "Delete" />
                        </form>

                        <!-- For Tooltip  -->
                        <a href="#" class="tooltip">
					    <?=$task['task_name']?>
					    <span>
					        <strong><?=$task['task_name']?></strong><br />
					        <?= $task['task_description'] ?>
					    </span>
						</a>
						<!-- For Tooltip  -->

                        <div class="countDown" dueDate="<?= $date_due ?>"><?= $left ?></div>               
                    </li>		
				<?php 
					}
					$index++;
				}
				?>
				
				<!--add-->
				<li>
					<form action = "manage.php" method = "post">
						<input type = "hidden" name = "type" value = "<?= $type ?>" />
						<input type = "hidden" name = "group_name" value = "<?= $group_name ?>" />
						<input type = "hidden" name = "action" value = "add" />
						<input name= "title" type="text" size="25" autofocus="autofocus" />
						<input type= "submit" value="Add" />
					</form>
				</li>
			</ul>  
    <?php   	
	}
	

	// display completed tasks
	function displayCTasks($tasks, $name){ ?>
		<h2><?=$name?> has completed these: </h2>
		<ul id="comList">
        	<?php
			foreach ($tasks as $task) {
				if ($task['complete'] == "c") {
			?>
                <li>
                    <!-- For Tooltip  -->
                    <a href="#" class="tooltip">
				    <?=$task['task_name']?>
				    <span>
				        <strong><?=$task['task_name']?></strong><br />
				        <?= $task['task_description'] ?>
				    </span>
					</a>
					<!-- For Tooltip  -->
                </li>		
			<?php 
				}
			} ?>
		</ul>
<?php	
	}
?>