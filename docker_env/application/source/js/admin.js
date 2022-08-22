$(window).on("load", function () {
    var role = sessionStorage.getItem("role");
    console.log(role);

    if(role  == "administrateur"){
    $("#usersAdmin").hide();
    $("#profilesAdmin").hide();
    $("#commentAdmin").hide();
    }

    else{
        $("#usersAdmin").hide();
        $("#profilesAdmin").hide();
        $("#commentAdmin").show();
        }
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