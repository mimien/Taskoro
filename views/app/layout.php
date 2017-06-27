<script src="resources/js/app.js"></script>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="?controller=Users&action=logout">Logout</a>
</div>
<span id="nav-icon" onclick="openNav()">&#9776; </span>
<div id="main-content">
    <img id="logo" src="resources/images/taskoro-logo.png" alt="logo">
    <h1 id="app-title">Taskoro</h1>
    <div id="task-bar">
        <h2 id="working-task"></h2>
        <a id="repeat-interval-btn" class="button">
            <i class="text-icon material-icons">repeat</i> Repeat interval
        </a>
        <a  id="skip-interval-btn" class="button">
            <i class="text-icon material-icons">skip_next</i> Skip interval
        </a>
        <br>
        <span id="current-interval"></span>
        <br>

        <a id="finish-task-btn" class="button">
            <i class="text-icon material-icons">done</i> Complete task
        </a>
    </div>
    <div id="tableContainer">
        <?php call('Obligations', 'table'); ?>
    </div>
</div>

<div id="obligation-modal" class="modal">
    <div id="modal-content">
        <span id="close-modal">&times;</span>
        <?php call('Obligations', 'createPage'); ?>
    </div>
</div>

<div id="information-modal" class="modal">
    <div id="modal-info-content">
        <span id="close-modal-info">&times;</span>
        <?php call('Obligations', 'infoPage'); ?>
    </div>
</div>