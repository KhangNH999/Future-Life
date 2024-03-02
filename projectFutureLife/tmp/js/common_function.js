// confirm delete
function confirm_delete (e) {
    if (confirm('Bạn có muốn xóa dữ liệu này?')) {
        return true;
    } else {
        e.stopPropagation(); 
        e.preventDefault();
    }
}