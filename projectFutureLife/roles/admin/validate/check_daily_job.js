// check daily job
function check_daily_job() {
    var daily_job_name = document.form_daily_job.daily_job_name.value;
    var time_start = document.form_daily_job.time_start.value;
    var text_error = document.getElementById("error-text");
    if (daily_job_name == "" || time_start == "") {
        text_error.innerHTML = "Vui lòng không được để trống tên công việc và ngày bắt đầu!";
        return false;
    }
    if (_is_check_special_character(daily_job_name)){
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