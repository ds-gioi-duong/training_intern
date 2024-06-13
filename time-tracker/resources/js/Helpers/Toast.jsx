import Toastify from 'toastify-js';

export function showToast(message, type = 'info') {
    Toastify({
        text: message,
        duration: 3000,  // Thời gian hiển thị toast (3 giây)
        gravity: 'bottom',  // Vị trí hiển thị (bottom, top, left, right)
        position: 'right',  // Đối với gravity = bottom hoặc top, position có thể là left hoặc right
        backgroundColor: type === 'success' ? '#32CD32' : '#FF6347', // Màu sắc của toast
    }).showToast();
}
