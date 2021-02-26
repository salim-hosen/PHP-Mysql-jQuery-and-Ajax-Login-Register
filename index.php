
		<?php
			include 'inc/header.php';
			include 'lib/user.php';
			$user = new User();
			
			Session::checkSession();
			
			$loginmsg = Session::get("loginmsg");
			
			if(isset($loginmsg)){
				echo $loginmsg;
			}
			Session::set('loginmsg',null);
		?>	
			<div class="panel panel-default">
			    <div class="panel-heading">
					<h2>User list <span class="pull-right"><strong>Welcome, </strong>
						<?php
							$getName = Session::get("username");
							if(isset($getName))
								echo $getName;
							
						?>
					</span></h2>
				</div>
			    <div class="panel-body">
					<table class="table table-stripped">
						<tr>
							<th width="20%">Serial</th>
							<th width="20%">Name</th>
							<th width="20%">Username</th>
							<th width="20%">Email Address</th>
							<th width="20%">Action</th>
						</tr>
						
					    <?php
							$result = $user->getUserData();
							if($result){
								$id = 1;
								foreach($result as $val){
						?>
						<tr>
							<td><?php echo $id++;?></td>
							<td><?php echo $val['fname'];?></td>
							<td><?php echo $val['username'];?></td>
							<td><?php echo $val['email'];?></td>
							<td>
								<a class="btn btn-primary" href="profile.php?id=<?php echo $val['id'];?>">View</a>
							</td>
						</tr>
								<?php } }else{?>
							<tr>
								<td><h2>No User Data Found.</h2></td>
							</tr>
							<?php }?>
					</table>
				</div>
			</div>
			
		<?php
			include 'inc/footer.php';
		?>		