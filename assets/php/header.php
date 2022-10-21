<?php
	require_once 'assets/php/session.php';
 
?>
<!DOCTYPE html>
<html lang= "en">
<head>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | CEIT Guidance Record System</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script type="text/javascript">
    $(document).ready(function(){

      // $('.dropdown-menu').on('click', function(e) {
      //   e.stopPropagation();
      // });
        // Send Message
        var uid;
          
        $("body").on("click", ".sendMessageIcon", function(e){
            uid = $(this).attr('id');
        });
        $("#MessageAdminBtn").click(function(e){
            if($("#message-admin-form")[0].checkValidity()){
              let message = $("#message").val();
              e.preventDefault();
              $("#MessageAdminBtn").val('Please Wait');

              $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: { uid: uid, message: message },
                success:function(response){
                  console.log(response);
                  $("#MessageAdminBtn").val('Send Reply');
                  $("#MessageAdminModal").modal('hide');
                  $("#message-admin-form")[0].reset();
                  Swal.fire(
                    'Sent!',
                    'Message sent successfully',
                    'success'
                  )
                }
              });
            }
        });

        // Check Notification
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
    })
  </script>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;900&display=swap');
		*{
			font-family: 'Maven Pro', san-serif;
		}
    
    .swal-modal {
    background-color: rgba(63,255,106,0.69);
    border: 3px solid white;
    }

    .dropdown-menu{
      width: 450px;
      
    }

    .footer{
      position: fixed;
      bottom: 0;
    }

    .dropdown-menu .dropdown-item > li > a:hover {
    background-image: none;
    
    background-color: #000!important;
    }

	</style>


</head>


<body style="background-image: linear-gradient(to right, #868f96 0%, #596164 100%); background-attachment: fixed;">
    
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php"><i class="fab fa-audible fa-lg"></i>&nbsp;&nbsp;CEIT Guidance Record System</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar" method="post">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a href="#" class="nav-link" id="navbardrop" data-toggle="dropdown">
          <i class="fas fa-bell fa-lg"><span id="checkNotification"></span></i>&nbsp;
        </a>
        <div class="dropdown-menu">
          
            <div class="dropdown-item text-primary">
              <h4><b>Notifications</b></h4>
            </div>
            <div class="divider"></div>
            <div class="dropdown-item" id="showAllNotif"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php")? "active":""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php")? "active":""; ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "events.php")? "active":""; ?>" href="events.php"><i class="fas fa-comment"></i>&nbsp;Events</a>
      </li>
      
      <li class="nav-item dropdown">
      	<a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
      		<i class="fas fa-user-cog"></i>&nbsp;Hi! <?= $cname; ?>
      	</a>
      	<div class="dropdown-menu">
          <a href="admin/index.php" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Admin Panel</a>
      		<a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
      	</div>
      </li>
    </ul>
  </div>
    <!-- Send Message to Admin -->
    <div class="modal fade" id="MessageAdminModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Send Message to Admin</h4>
            <button type="button" class="close" data-dismiss="modal">&times</button>
          </div>
          <div class="modal-body">
            <form method="post" action="#" class="px-3" id="message-admin-form">
              <div class="form-group">
                <textarea name="message" id="message" class="form-control" rows="6" placeholder="Write your Message" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-block" id="MessageAdminBtn">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</nav>