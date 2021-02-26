
		<?php
			include 'inc/header.php';
			include_once 'lib/User.php';
			
			Session::checkSession();
			if(isset($_GET['id'])){
				$userid = (int) $_GET['id'];
			}
			$user = new User();
		?>	
		<?php
				if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])){
					$updateUser = $user->updateUserData($userid,$_POST);
					if($updateUser){
						echo $updateUser;
					}
				}
		?>
			<div class="panel panel-default">
			    <div class="panel-heading">
					<h2>User Profile <span class="pull-right"><a href="index.php" class="btn btn-primary">Back</a></span></h2>
				</div>
			    <div class="panel-body">
					<div style="width:600px;margin:0 auto;">
					<?php
						$userData = $user->getUserById($userid);
						if($userData){
					?>
						<form action="" method="POST">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" id="name" name="name" class="form-control" value="<?php echo $userData->fname;?>"/>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" id="username" name="username" class="form-control" value="<?php echo $userData->username;?>"/>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" id="email" name="email" class="form-control" value="<?php echo $userData->email;?>"/>
							</div>
					    <?php
						    $loginId = Session::get("id");
							if($loginId == $userid){
						?>
							<button type="submit" name="update" class="btn btn-success">Update</button>
							<a class="btn btn-info" href="changepass.php?id=<?php echo $userid;?>">Change Password</a>
						</form>
							<?php } }?>
					</div>
				</div>
			</div>
			
		<?php
			include 'inc/footer.php';
		?>		