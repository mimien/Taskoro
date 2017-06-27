<script src="resources/js/users.js"></script>
<img id="logo" src="resources/images/taskoro-logo.png" alt="logo">
<h1>Welcome to Taskoro</h1>
<div id="user-fieldset">
   <?php 
   call("Users", "loginPage");
   call("Users", "registerPage");
   ?>
</div>