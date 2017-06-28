$(document).ready(function () {
    $("#register-btn").click(signup);
    $("#login-btn").click(login);
});

function signup() {
    var jsonToSend = {
        "controller": "Users",
        "action": "create",
        "name": $("#name-rg").val(),
        "email": $("#email-rg").val(),
        "password": $("#passwd-rg").val()
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (registration) {
            if (registration.succesful) {
                alert("Welcome to Taskoro ");
            } else {
                alert("User account already exists");
            }
        },
        error: function (errorMsg) {
            $("html").html(errorMsg.responseText);
        }
    });
}

function login() {
    var jsonToSend = {
        "controller": "Users",
        "action": "verify",
        "email": $("#email-lg").val(),
        "password": $("#passwd-lg").val()
    };

    $.ajax({
        url: "PostRoutes.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (login) {
            if (login.ok) {
                location.reload();
                alert("Welcome back");
            } else {
                alert("Incorrect username and/or password");
            }
        },
        error: function (errorMsg) {
            alert("Bad connection");
            $("html").html(errorMsg.responseText);
        }
    });
}