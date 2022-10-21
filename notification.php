<?php 
require_once 'assets/php/header.php';
 ?>

<div class="container">
	<div class="row justify-content-end d-flex my-2">
		<div class="col-lg-6 mt-4" id="showAllNotif">
			
		</div>
	</div>
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	// Fetch Notif of User
	fetchNotification();
	function fetchNotification(){
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'fetchNotification' },
			success:function(response){
				//console.log(response);
				$("#showAllNotif").html(response);
				
				
			}
		});

	}
	//Check Notification
	checkNotification();
	function checkNotification(){
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'checkNotification' },
			success:function(response){
				
				$("#checkNotification").html(response);
				
			}
		});
	}

	//Delete Notification
	$("body").on("click", ".close", function(e){
		e.preventDefault();

		notification_id = $(this).attr('id');

		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { notification_id: notification_id },
			success:function(response){
				checkNotification();
				fetchNotification();

			}


		});
	});
});


</script>
</body>
</html>

