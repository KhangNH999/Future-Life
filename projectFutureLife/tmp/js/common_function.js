// confirm delete
function confirm_delete(e) {
    if (confirm('Bạn có muốn xóa dữ liệu này?')) {
        return true;
    } else {
        e.stopPropagation();
        e.preventDefault();
    }
}

// message warning
document.addEventListener("DOMContentLoaded", function () {
    var warningMessage = document.querySelector('.message_warning');
    requestAnimationFrame(function () {
        warningMessage.style.opacity = 1;
    });
});

// message success
document.addEventListener("DOMContentLoaded", function () {
    var warningMessage = document.querySelector('.message_success');
    requestAnimationFrame(function () {
        warningMessage.style.opacity = 1;
    });
});

// clear input daily job
function clear_input_daily_job() {
    var id = document.getElementById('id_daily_job');
    var name = document.getElementById('daily_job_name');
    var time_from = document.getElementById('time_start_from');
    var time_to = document.getElementById('time_start_to');
    id.value = '';
    name.value = '';
    time_from.value = '';
    time_to.value = '';
}

// clear input future plan
function clear_input_future_plan() {
    var id = document.getElementById('id_future_plan');
    var name = document.getElementById('future_plan_name');
    var time = document.getElementById('time_start');
    id.value = '';
    name.value = '';
    time.value = '';
}

// clear input cost
function clear_input_cost() {
    var id = document.getElementById('id_cost');
    var name = document.getElementById('cost_name');
    var cost = document.getElementById('cost');
    var time = document.getElementById('date_used');
    id.value = '';
    name.value = '';
    cost.value = '';
    time.value = '';
}

// Gets all checkboxes in the column when the checkbox in the card is selected
document.addEventListener("DOMContentLoaded", function () {
    const headerCheckbox = document.querySelector("th input[type='checkbox']");
    const checkboxes = document.querySelectorAll("td input[type='checkbox']");
    headerCheckbox.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = headerCheckbox.checked;
        });
    });
});