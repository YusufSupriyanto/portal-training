$(document).ready(function() {
    $('#example').DataTable();
});


const list = $('.success').data('success')
if (list) {
    Swal.fire({
        title: list,
        text: '',
        icon: 'success'
    })
}

$(document).ready(function() {
    $('#example2').DataTable();
});


$('.btn-delete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).parents('form');
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Menghapus Category ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            href.submit();
        }
    })
});

//user
$(document).ready(function() {
    $('#user-table').DataTable();
});

$(document).ready(function() {
    $('#member').DataTable();
});

$(document).ready(function() {
    $('#personal-schedule').DataTable();
});