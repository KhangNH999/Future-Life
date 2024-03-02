// check login
function check_login() {
    var user_name = document.login_form.user_name.value;
    var password = document.login_form.password.value;
    var text_error = document.getElementById("error-text");
    if (user_name != "" && password != "") {
        return true;
    } else {
        text_error.innerHTML = "Vui lòng không được để trống user và password!";
        return false;
    }
}