$(document).ready(function () {
    $("#new-obtask-btn").click(addObligatoryTask);
    $('*[id^="ob-start"]').click(StartObligatoryTask);
    $('*[id^="more-info"]').click(moreInfoTask);
    $("#repeat-interval-btn").click(repeatInterval);
    $("#skip-interval-btn").click(skipInterval);
    modalFunctionality();
});

// pomodoro data
var mins = 20;
var secs = mins * 60;
var currentSeconds = 0;
var currentMinutes = 0;
var isLeisureTime = false;
var currentInterval;
var obligationID;
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
            incrementInterval(obligationID);
            currentInterval++;
            $("#repeat-interval-btn").hide();
            $("#skip-interval-btn").hide();
            startLeisureTime(20);
        }
        else {
            incrementInterval(obligationID);
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
    obligationID = separateData[2];
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
    incrementInterval(obligationID);
    currentInterval++;

    isLeisureTime = true;
    $("#working-task").text("You are doing leisure time on " + obTaskName);
    mins = ((currentInterval % 4) === 0 && currentInterval > 0)? 20 : 5;
    secs = mins * 60;
    currentSeconds = 0;
    currentMinutes = 0;
    $("#repeat-interval-btn").hide();
    $("#skip-interval-btn").hide();
}

function moreInfoTask() {
    var jsonToSend = {
        "controller": "Obligations",
        "action": "showOne",
        "oID": $(this).attr("id").split("-")[2]
    };

    $("#create-obligation-btn").click(function () {
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
        "controller": "Obligations",
        "action": "updateInterval",
        "oID": obligationID
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

function addObligatoryTask() {
    var jsonToSend = {
        "controller": "Obligations",
        "action": "create",
        "name": $("#name-new-obtask").val(),
        "notes": $("#notes-new-obtask").val(),
        "date": $("#date-new-obtask").val()
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
                alert("Llena los datos correctamente");
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
    $("#close-modal").click(function () {
        $("#obligation-modal").hide();
    });

    $("#create-obligation-btn").click(function () {
        $("#obligation-modal").show();
    });

    $("#close-modal-info").click(function () {
        $("#information-modal").hide();
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