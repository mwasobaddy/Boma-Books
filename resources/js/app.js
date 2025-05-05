import './bootstrap';
import Swal from 'sweetalert2';

// Make Swal (SweetAlert2) globally available
window.Swal = Swal;

// Default toast configuration
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});