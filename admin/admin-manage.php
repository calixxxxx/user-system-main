<?php 

	require_once 'assets/php/admin-header.php';
	require_once 'assets/php/admin-db.php';
	$count = new Admin();

 ?>


<div class="container-fluid">
 	<div class="d-flex justify-content-between">
		<div class="col-lg-8 mt-4">
			<div class="col-xl-12">
				<!-- Generate Report -->
				<div class="card my-3 border-info">
					<div class="card-header bg-info text-white justify-content-between d-flex">
						<h4 class="mr-5">Generate Record Report</h4>
					</div>
					<div class="card-body">
						<form data-form="reportForm" class="px-3 form-floating">
							<div class="form-row mb-3">
								<div class="col-4">
									<select class="form-control" data-select="report" onchange="OptionsReset();">
										<option value="" disabled selected>Select report</option>
										<option value="incidentReport">Incident Reports</option>
										<option value="consultationReport">Consultation Reports</option>
										<option value="acceptanceSlip">Acceptance Slips</option>
									</select>
								</div>
								<div class="col-4">
									<select class="form-control" data-select="range" onchange="OptionsChange(this.value);">
										<option value="" disabled selected>Select range type</option>
										<option value="monthly">Monthly</option>
										<option value="semestral">Semestral</option>
										<option value="annual">Annual</option>
									</select>
								</div>
								<div class="col-4">
									<select class="form-control" data-select="date">
										<option value="" disabled selected>Select date</option>
									</select>
								</div>
							</div>
							<div class="form-row mb-3">
								<div class="col-12">
									<button class="btn btn-info float-right" type="submit" data-submit="generateReport">Generate</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				<!-- Generate Good Moral -->
				<div class="card my-3 border-info">
					<div class="card-header bg-info text-white">
						<h4 class="mr-5">Generate Good Moral</h4>
					</div>
					<div class="card-body">
						<form data-form="goodMoralForm" class="px-3 form-floating">
							<div class="form-row mb-3">
								<div class="col-3">
									<select class="form-control" data-select="title">
										<option value="" disabled selected>Select Title</option>
										<option value="mr">Mr.</option>
										<option value="ms">Ms.</option>
									</select>
								</div>
								<div class="col-9">
									<input  class="form-control" type="text" data-input="name" placeholder="Enter Full Name...">
								</div>
							</div>
							<div class="form-row mb-3">
								<div class="col-9">
									<select class="form-control" data-select="course">
										<option value="" disabled selected>Select Course</option>
										<option value="BSOA">Bachelor of Science in Office Administration (BSOA)</option>
										<option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
										<option value="BSCS">Bachelor of Science in Computer Science (BSCS)</option>
										<option value="BSArchi">Bachelor of Science in Architecture (BSArchi)</option>
										<option value="BSABE">Bachelor of Science in Agricultural and Biosystems Engineering (BSABE)</option>
										<option value="BSCE">Bachelor of Science in Civil Engineering (BSCE)</option>
										<option value="BSEE">Bachelor of Science in Electrical Engineering (BSEE)</option>
										<option value="BSCpE">Bachelor of Science in Computer Engineering (BSCpE)</option>
										<option value="BSECE">Bachelor of Science in Electronics and Communication Engineering (BSECE)</option>
										<option value="BSIE">Bachelor of Science in Industrial Engineering (BSIE)</option>
										<option value="BSIndt-ET">Bachelor of Industrial Technology major in Electrical Technology (BS Indt- ET)</option>
										<option value="BSIndt-AT">Bachelor of Industrial Technology major in Automotive Technology (BS Indt- AT)</option>
										<option value="BSIndt-ELEX">Bachelor of Industrial Technology major in Electronics (BS Indt- ELEX)</option>
									</select>
								</div>
								<div class="col-3">
									<button class="btn btn-info float-right" type="submit" data-submit="generateGoodMoral">Generate</button>
								</div>
							</div>
						</form>		
					</div>
				</div>
			</div>
		</div>
 		<div class="col-lg-4 mt-4" id="showNotification"></div>
 	</div>
</div>

 <!-- Footer Area -->
 			</div>
 		</div>
 	</div>
	<div class="footer">
	<img src="../assets/img/cvsu.png" width="60" height="60" alt="">
	</div>
 	<script type="text/javascript">
 		$(document).ready(function(){

 			//Fetch Notif
 			fetchNotification();
 			function fetchNotification(){
 				$.ajax({
 					url: 'assets/php/admin-action.php',
 					method: 'post',
 					data: { action: 'fetchNotification' },
 					success: function(response){
 						$("#showNotification").html(response);
 					}
 				})
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

 			//Remove Notification
 			$("body").on("click", ".close", function(e){
 				e.preventDefault();

 				notification_id = $(this).attr('id');
 				$.ajax({
 					url: 'assets/php/admin-action.php',
 					method: 'post',
 					data: { notification_id: notification_id },
 					success:function(response){
 						fetchNotification();
 						checkNotification();
 					}
 				})
 			});

			

			//Delete Record type
			$("body").on("click", ".deleteTypeIcon", function(e){
				type_id = $(this).attr('id');

					Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Delete it!'
					}).then((result) => {
					if (result.value) {
						$.ajax({
							url: 'assets/php/admin-action.php',
							method: 'post',
							data: { type_id: type_id },
							success: function(response){
							Swal.fire(
						'Delete!',
						'Record Type has been deleted.',
						'success'	
						)
						fetchRecordTypes();


						}
						});
					}
					})
						
					});

 		});

 		const generateReportForm = document.querySelector('[data-form="reportForm"]');
 		const generateReportBtn = document.querySelector('[data-submit="generateReport"]');
 		const reportSelect = document.querySelector('[data-select="report"]');
 		const rangeSelect = document.querySelector('[data-select="range"]');
 		const dateSelect = document.querySelector('[data-select="date"]');

 		let defaultOptions = '<option value="" disabled selected>Select date</option>';

 		generateReportBtn.addEventListener("click", (e) => {
 			e.preventDefault();
 			if(reportSelect.options[reportSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Incomplete parameters!',
 					text: 'Must select a report, range and date'
 				});
 				return;
 			}
 			if(rangeSelect.options[rangeSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Incomplete parameters!',
 					text: 'Must select a report, range and date'
 				});
 				return;
 			}
 			if(dateSelect.options[dateSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Incomplete parameters!',
 					text: 'Must select a report, range and date'
 				});
 				return;
 			}
 			let path = "http://localhost/user-system-main/InfinityBrackets/reports.php?report=" + reportSelect.options[reportSelect.selectedIndex].value + "&range=" + rangeSelect.options[rangeSelect.selectedIndex].value + "&date=" + dateSelect.options[dateSelect.selectedIndex].value;
 			window.open(path, "_blank");

 			generateReportForm.reset();
 		});

 		function OptionsChange(value) {
 			if(reportSelect.options[reportSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Incomplete parameters!',
 					text: 'Must select a report, range and date'
 				});
 				rangeSelect.selectedIndex = 0;
 				return;
 			}
 			$.ajax({
				url : "assets/php/admin-action.php",
				type: "POST",
				data : "action=changeoptions&value=" + value + "&report=" + reportSelect.options[reportSelect.selectedIndex].value,
				success: function(response) {
					dateSelect.innerHTML = JSON.parse(response).data;
				}
			});
 		}

 		function OptionsReset() {
 			rangeSelect.selectedIndex = 0;
 			dateSelect.innerHTML = '<option value="" disabled selected>Select date</option>';
 			dateSelect.selectedIndex = 0;
 		}

 		const generateGoodMoralBtn = document.querySelector('[data-submit="generateGoodMoral"]');
 		const titleSelect = document.querySelector('[data-select="title"]');
 		const nameInput = document.querySelector('[data-input="name"]');
 		const courseSelect = document.querySelector('[data-select="course"]');

 		generateGoodMoralBtn.addEventListener("click", (e) => {
 			e.preventDefault();
 			if(nameInput.value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Fill up all fields!',
 					text: 'Must select a title, course and input name'
 				});
 				return;
 			}
 			if(titleSelect.options[titleSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Fill up all fields!',
 					text: 'Must select a title, course and input name'
 				});
 				return;
 			}
 			if(courseSelect.options[courseSelect.selectedIndex].value === "") {
 				Swal.fire({
 					type: 'info',
 					title: 'Fill up all fields!',
 					text: 'Must select a title, course and input name'
 				});
 				return;
 			}
			if(!CleanName(nameInput.value)) {
				Swal.fire({
 					type: 'error',
 					title: 'Invalid input!',
 					text: 'Name must contain only letters and spaces'
 				});
 				return;
			}
 			let path = "http://localhost/user-system-main/InfinityBrackets/good-moral.php?title=" + titleSelect.options[titleSelect.selectedIndex].value + "&name=" + nameInput.value + "&course=" + courseSelect.options[courseSelect.selectedIndex].value;
 			window.open(path, "_blank");

 			document.querySelector('[data-form="goodMoralForm"]').reset();
 		});

		function CleanName(phrase) {
			return /^[A-Za-z\s]*$/.test(phrase);
		}
 	</script>
 </body>
 </html>