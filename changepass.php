
		<?php
			include 'inc/header.php';
			include_once 'lib/User.php';
			
			Session::checkSession();
			if(isset($_GET['id'])){
				$userid = (int) $_GET['id'];
				$sid = Session::get("id");
				if($userid != $sid){
					header("Location: index.php");
				}
			}
			$user = new User();
		?>	
		<?php
				if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['updatePass'])){
					$updatePass = $user->updateUserPassword($userid,$_POST);
					if($updatePass){
						echo $updatePass;
					}
				}
		?>
			<div class="panel panel-default">
			    <div class="panel-heading">
					<h2>Change Password<span class="pull-right"><a href="profile.php?id=<?php echo $userid?>" class="btn btn-primary">Back</a></span></h2>
				</div>
			    <div class="panel-body">
					<div style="width:600px;margin:0 auto;">
						<form action="" method="POST">
							<div class="form-group">
								<label for="old_password">Old Password</label>
								<input type="password" id="oldPass" name="oldPassword" class="form-control"/>
							</div>
							<div class="form-group">
								<label for="password">New Password</label>
								<input type="password" id="newPass" name="newPassword" class="form-control"/>
							</div>
							<button type="submit" name="updatePass" class="btn btn-success">Update</button>
						</form>
					</div>
				</div>
			</div>
			
		<?php
			include 'inc/footer.php';
		?>		