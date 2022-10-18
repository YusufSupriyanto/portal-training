$(document).ready(function() {
    $('#example').DataTable();
});

$(document).ready(function() {
    $('#mytable').DataTable();
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
        text: "Menghapus Data ?",
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

$(document).ready(function() {
    $('#History').DataTable();
});