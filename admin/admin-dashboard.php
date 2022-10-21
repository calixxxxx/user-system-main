<?php 

	require_once 'assets/php/admin-header.php';
	require_once 'assets/php/admin-db.php';
	$count = new Admin();

 ?>


 </style>
 	<div class="row justify-content-center">
 		<div class="col-lg-10">
 			<div class="card-deck mt-5 mr-3 text-light text-center font-weight-bold">
 				
 				<div class="card bg-info">
 					<div class="card-header"><i class="fas fa-users"></i>&nbsp;&nbsp;<a href="admin-users.php" class="text-light">Total Users</a></div>
 					<div class="card-body">
 						<h1 class="display-4">
	 						<?=$count->total_count('users');  ?>

	 						
 						</h1>
 					</div>
 				</div>

 				<div class="card bg-info">
 					<div class="card-header"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp;<a href="admin-records.php" class="text-light">Total Records</a></div>
 					<div class="card-body">
 						<h1 class="display-4">
						 	<?=$count->total_count('incident_reports');  ?>
 						</h1>
 					</div>
 				</div>

				 <div class="card bg-info">
 					<div class="card-header"><i class="fas fa-calendar-week"></i>&nbsp;&nbsp;<a href="admin-events.php" class="text-light">Total Events</a></div>
 					<div class="card-body">
 						<h1 class="display-4">
 							<?=$count->total_count('all_events');  ?>
 						</h1>
 					</div>
 				</div>

				<div class="card bg-info">
 					<div class="card-header"><i class="fas fa-bell"></i>&nbsp;&nbsp;<a href="admin-manage.php" class="text-light">Total Notifications</a></div>
 					<div class="card-body">
 						<h1 class="display-4">
 							<?=$count->total_count('notification');  ?>
 						</h1>
 					</div>
 				</div>

				<!-- <div class="card bg-info">
 					<div class="card-header"><i class="fas fa-archive"></i>&nbsp;&nbsp;<a href="admin-manage.php" class="text-light">Total Record Type</a></div>
 					<div class="card-body">
 						<h1 class="display-4">
 							<?=$count->total_count('record_types');  ?>
 						</h1>
 					</div>
 				</div> -->
 				

 				<!-- <div class="card bg-info">
 					<div class="card-header"><i class="fas fa-street-view"></i> System Visitors</div>
 					<div class="card-body">
 						<h1 class="display-4">
	 						<?php $data = $count->site_visitors(); echo $data['hits'];  ?>
 						</h1>
 					</div>
 				</div> -->

 			</div>
 		</div>
 	</div>

	<!-- <div class="row justify-content-center">
 		<div class="col-xm-10">
 			<div class="card-deck my-3 font-weight-bold">
			 	
				Start Latest User
				<div class="row">
 					<div class="col-lg-12">
 						<div class="card my-3 border-info">
 							<div class="card-header bg-info text-white justify-content-between d-flex">
 								<h4 class="m-0">Latest Users</h4>
								
						 	</div>
							<div class="card-body">
								<div class="table-responsive" id="showAllUsers">
									<p class="text-center align-self-center lead">Please Wait</p>
								</div>
							</div>
 						</div>
 					</div>
 				</div>
				End Latest Users
				 
 			</div>
 		</div>
 	</div> -->

	<div class="row justify-content-center">
 		<div class="col-xm-10">
 			<div class="card-deck my-3 font-weight-bold">
			 	
				
				 <!-- Start Incident Records -->
				<div class="row">
 					<div class="col-lg-12">
 						<div class="card my-3 border-info">
 							<div class="card-header bg-info text-white justify-content-between d-flex">
 								<h4 class="m-0">Latest Incident Records</h4>
								
						 	</div>
							<div class="card-body">
								<div class="table-responsive" id="showLatestIncident">
									<p class="text-center align-self-center lead">Please Wait</p>
								</div>
							</div>
 						</div>
 					</div>
 				</div>
				 <!-- latest records -->
				  <!-- Start Consult Records -->
				<div class="row">
 					<div class="col-lg-12">
 						<div class="card my-3 border-info">
 							<div class="card-header bg-info text-white justify-content-between d-flex">
 								<h4 class="m-0">Latest Consultation Records</h4>
								
						 	</div>
							<div class="card-body">
								<div class="table-responsive" id="showLatestConsult">
									<p class="text-center align-self-center lead">Please Wait</p>
								</div>
							</div>
 						</div>
 					</div>
 				</div>
				 <!-- latest records -->
				  <!-- Start Acceptance Records -->
				<div class="row">
 					<div class="col-lg-12">
 						<div class="card my-3 border-info">
 							<div class="card-header bg-info text-white justify-content-between d-flex">
 								<h4 class="m-0">Latest Acceptance Records</h4>
								
						 	</div>
							<div class="card-body">
								<div class="table-responsive" id="showLatestAccept">
									<p class="text-center align-self-center lead">Please Wait</p>
								</div>
							</div>
 						</div>
 					</div>
 				</div>
				 <!-- latest records -->
 			</div>
 		</div>
 	</div>

	 <div class="row justify-content-center">
 		<div class="col-lg-8">
 			<div class="card-deck my-3 font-weight-bold">
 				
 				<div class="card border-info">
 					<div class="card-header bg-info text-center text-white">
 						<i class="fas fa-venus-mars fa-lg"></i> Male and Female Users
 					</div>
 					<div id="chartOne" style="width: 100%; height: 350px;"></div>
 				</div>

 				<div class="card border-info">
 					<div class="card-header bg-info text-center text-white">
 						<i class="fas fa-user"></i> Verified and Unverified Users
 					</div>
 					<div id="chartTwo" style="width: 100%; height: 350px;"></div>
 				</div>

 			</div>
 		</div>
 	</div>


 <!-- Footer Area -->
 			</div>
 		</div>
 	</div>
	<div class="footer">
	<img src="../assets/img/cvsu.png" width="60" height="60" alt="">
	</div>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
 	google.charts.load("current", {packages:["corechart"]});
 		google.charts.setOnLoadCallback(pieChart);
 		function pieChart(){
 			var data = google.visualization.arrayToDataTable([
 				['Gender', 'Number'],
 				<?php 
 					$gender = $count->gender_percent();
 					foreach ($gender as $row) {
 						echo '["'.$row['gender'].'",'.$row['number'].'],';
 					}
 				?>
 			]);
 			var options = {
 				is3D: false
 			};
 			var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
 			chart.draw(data,options);
 		}

 		google.charts.load("current", {packages:["corechart"]});
 		google.charts.setOnLoadCallback(colChart);
 		function colChart(){
 			var data = google.visualization.arrayToDataTable([
 				['Verified', 'Number'],
 				<?php 
 					$verified = $count->users_percent();
 					foreach ($verified as $row) {
 						if ($row['verified'] == 0){
 							$row['verified'] = "Unverified";
 						}
 						else{
 							$row['verified'] = "Verified";
 						}
 						echo '["'.$row['verified'].'",'.$row['number'].'],';
 					}
 				 ?>
 			]);
 			var options = {
 				pieHole: 0.1,
 			};
 			var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
 			chart.draw(data,options);
 		}
		 	//Get Latest Incident Records
		 	fetchLatestIncidentRecords();
 			function fetchLatestIncidentRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'LatestIncidentRecords' },
 				success:function(respone){
 					$("#showLatestIncident").html(respone);
 					
 				}
 			});
 			}
			// Get Latest Consult
			fetchLatestConsultRecords();
 			function fetchLatestConsultRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'LatestConsultRecords' },
 				success:function(respone){
 					$("#showLatestConsult").html(respone);
 					
 				}
 			});
 			}

			// Get Latest Accept
			fetchLatestAcceptRecords();
 			function fetchLatestAcceptRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'LatestAcceptRecords' },
 				success:function(respone){
 					$("#showLatestAccept").html(respone);
 					
 				}
 			});
 			}

			 //Get Latest Users
 			fetchAllLatestUsers();
 			function fetchAllLatestUsers(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchAllLatestUsers' },
 				success:function(respone){
 					$("#showAllUsers").html(respone);
 					
 				}
 			});
 			}


 			//Check Notification
 			checkNotification();
 			function checkNotification(){
 				$.ajax({
 					url: 'assets/php/admin-action.php',
 					method: 'post',
 					data: { action: 'checkNotification' },
 					success:function(response){
 						$("#checkNotification").html(response);
 					}
 				})
 			}


 </script>
 </body>
 </html>