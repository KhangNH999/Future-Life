// check cost
function check_cost() {
    var cost_name = document.form_cost.cost_name.value;
    var cost = document.form_cost.cost.value;
    var date_used = document.form_cost.date_used.value;
    var text_error = document.getElementById("error-text");
    if (cost_name == "" || cost == "" || date_used == "") {
        text_error.innerHTML = "Vui lòng không được để trống tên chi tiêu, phí bỏ ra và ngày sử dụng!";
        return false;
    }
    if (_is_check_special_character(cost_name) || _is_check_special_character(cost)){
        text_error.innerHTML = "Tên chi tiêu hoặc phí bỏ ra không được chứa ký tự đặc biệt!";
        return false;
    }
    return true;
}

// check special character input
function _is_check_special_character(input) {
    var check_regrex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return check_regrex.test(input);
}