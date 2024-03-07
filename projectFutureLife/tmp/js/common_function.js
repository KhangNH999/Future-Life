// confirm delete
function confirm_delete (e) {
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

// clear input daily job
function clear_input_daily_job() {
    var id = document.getElementById('id_daily_job');
    var name = document.getElementById('daily_job_name');
    var time = document.getElementById('time_start');
    id.value = '';
    name.value = '';
    time.value = '';
}