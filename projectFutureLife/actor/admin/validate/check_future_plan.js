// check daily job
function check_future_plan() {
    var future_plan_name = document.form_future_plan.future_plan_name.value;
    var time_start = document.form_future_plan.time_start.value;
    var text_error = document.getElementById("error-text");
    if (future_plan_name == "" || time_start == "") {
        text_error.innerHTML = "Vui lòng không được để trống tên dự định và ngày bắt đầu!";
        return false;
    }
    if (_is_check_special_character(future_plan_name)){
        text_error.innerHTML = "Tên công việc không được chứa ký tự đặc biệt!";
        return false;
    }
    return true;
}

// check special character input
function _is_check_special_character(input) {
    var check_regrex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return check_regrex.test(input);
}