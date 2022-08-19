const list = $('.import').data('import')
if (list) {
    Swal.fire({
        title: list,
        text: '',
        icon: 'success'
    })
}