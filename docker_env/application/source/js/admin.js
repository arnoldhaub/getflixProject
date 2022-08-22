$(window).on("load", function () {
    $("#usersAdmin").hide();
    $("#profilesAdmin").hide();
    $("#commentAdmin").show();
});

$("#usersAdminInterface").click(function () {
    $("#usersAdmin").show();
    $("#profilesAdmin").hide();
    $("#commentAdmin").hide();
});

$("#profilesAdminInterface").click(function () {
    $("#usersAdmin").hide();
    $("#profilesAdmin").show();
    $("#commentAdmin").hide();
});

$("#commentsAdminInterface").click(function () {
    $("#usersAdmin").hide();
    $("#profilesAdmin").hide();
    $("#commentAdmin").show();
});