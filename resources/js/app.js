$(document).ready(function () {
    $("#new-task-btn").click(addTask);
    $("#new-project-btn").click(addProject);
    $('*[id^="ob-start"]').click(StartObligatoryTask);
    $('*[id^="more-info"]').click(moreInfoTask);
    $("#repeat-interval-btn").click(repeatInterval);
    $("#skip-interval-btn").click(skipInterval);
    $("#finish-task-btn").click(completeTask);
    modalFunctionality();
});

// pomodoro data
var mins = 20;
var secs = mins * 60;
var currentSeconds = 0;
var currentMinutes = 0;
var isLeisureTime = false;
var currentInterval;
var taskID;
var obTaskName;

function Decrement() {
    currentMinutes = Math.floor(secs / 60);
    currentSeconds = secs % 60;
    if (currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
    secs--;
    $("#app-title").text(currentMinutes + ":" + currentSeconds); //Set the element id you need the time put into.
    if (secs === -1) {
        if (isLeisureTime) {
            $("#current-interval").text("Current interval: " + currentInterval);
            $("#repeat-interval-btn").show();
            $("#skip-interval-btn").show();
            startAnotherInterval();
        } else if ((currentInterval % 4) === 0 && currentInterval > 0) {
            incrementInterval(taskID);
            currentInterval++;
            $("#repeat-interval-btn").hide();
            $("#skip-interval-btn").hide();
            startLeisureTime(20);
        }
        else {
            incrementInterval(taskID);
            currentInterval++;
            $("#repeat-interval-btn").hide();
            $("#skip-interval-btn").hide();
            startLeisureTime(5);
        }
    }
    else {
        setTimeout(Decrement, 1000);
    }
}

function StartObligatoryTask() {
    var separateData = $(this).attr("id").split("-");
    taskID = separateData[2];
    obTaskName = separateData[3];
    currentInterval = separateData[4];

    $("#working-task").text("You are doing " + obTaskName);
    $("#current-interval").text("Current interval: " + currentInterval);
    $('*[id^="ob-start"]').hide();
    $("#task-bar").show();
    Decrement();
}

function startLeisureTime(timeOfLeisure) {
    isLeisureTime = true;
    mins = timeOfLeisure;
    secs = mins * 60;
    currentSeconds = 0;
    currentMinutes = 0;
    $("#working-task").text("You are doing leisure time on " + obTaskName);
    Decrement();
}

function startAnotherInterval() {
    isLeisureTime = false;
    mins = 20;
    secs = mins * 60;
    currentSeconds = 0;
    currentMinutes = 0;
    Decrement();
}

function repeatInterval() {
    $("#app-title").text(mins + ":00");
    secs = mins * 60;
}

function skipInterval() {
    incrementInterval(taskID);
    currentInterval++;

    isLeisureTime = true;
    $("#working-task").text("You are doing leisure time on " + obTaskName);
    mins = ((currentInterval % 4) === 0 && currentInterval > 0) ? 20 : 5;
    secs = mins * 60;
    currentSeconds = 0;
    currentMinutes = 0;
    $("#repeat-interval-btn").hide();
    $("#skip-interval-btn").hide();
}

function moreInfoTask() {
    var jsonToSend = {
        "controller": "Tasks",
        "action": "showOne",
        "oID": $(this).attr("id").split("-")[2]
    };

    $("#create-task-btn").click(function () {
    });
    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (task) {
            $("#task-name").text(task.name);
            $("#task-notes").text(task.notes);
            $("#task-intervals").text(task.currentInterval);
            $("#task-date").text(task.dueDate);
            $("#information-modal").show();
        },
        error: function (errorMsg) {
            alert("go");
            $("html").html(errorMsg.responseText);
        }
    });
}
function incrementInterval() {
    var jsonToSend = {
        "controller": "Tasks",
        "action": "updateInterval",
        "oID": taskID
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (update) {
            if (update.ok) {
                alert("Task Interval updated on database");
            }
        },
        error: function (errorMsg) {
            $("html").html(errorMsg.responseText);
        }
    });
}


function completeTask() {
    var jsonToSend = {
        "controller": "Tasks",
        "action": "complete",
        "taskID": taskID
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function () {
            alert("You completed the task!");
            location.reload();
        },
        error: function (errorMsg) {
            $("html").html(errorMsg.responseText);
        }
    });
}

function addTask() {
    var jsonToSend = {
        "controller": "Tasks",
        "action": "create",
        "name": $("#name-new-task").val(),
        "notes": $("#notes-new-task").val(),
        "date": $("#date-new-task").val(),
        "projectId": $("#project-id").val()
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (taskCreated) {
            if (taskCreated.succesful) {
                location.reload();
            } else {
                alert("Fill data correctly");
            }
        },
        error: function (errorMsg) {
            $("html").html(errorMsg.responseText);
        }
    });
}

function addProject() {
    var jsonToSend = {
        "controller": "Projects",
        "action": "create",
        "name": $("#name-new-project").val(),
        "notes": $("#notes-new-project").val(),
        "date": $("#date-new-project").val()
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (projectCreated) {
            if (projectCreated.succesful) {
                location.reload();
            } else {
                alert("Fill data correctly");
            }
        },
        error: function (errorMsg) {
            $("html").html(errorMsg.responseText);
        }
    });
}

//
// User interface functionality
//
function modalFunctionality() {
    $('*[id^="new-task-project"]').click(function () {
        $("#project-id").val($(this).attr("id").split("-")[3]);
        $("#task-modal").show();
    });

    $("#close-modal").click(function () {
        $("#project-id").val("-1");
        $("#task-modal").hide();
    });

    $("#create-task-btn").click(function () {
        $("#task-modal").show();
    });

    $("#close-modal-info").click(function () {
        $("#information-modal").hide();
    });

    $("#create-project-btn").click(function () {
        $("#project-modal").show();
    });

    $("#close-modal-project").click(function () {
        $("#project-modal").hide();
    });

}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main-content").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main-content").style.marginLeft = "0";
}