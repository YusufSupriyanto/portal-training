<script>
$('#kadiv-verify').on('click', '.kadiv-verify', function() {
    var id_tna = $(this).attr('data-reject-kadiv');
    console.log(id_tna);
    jQuery.noConflict()
    $("#rejectKadiv").modal("show");
})

function reject_kadiv(id_tna) {
    const alasan = $('#alasan').val()
    console.log(id_tna);
    console.log(alasan);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_kadiv",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            alasan: alasan
        },
        success: function(data) {
            window.location.reload()

        }

    })

}

$("#kadiv-accept").on('click', function() {
    var id_tna = $('#tna').val();
    var id_user = $('#user').val();

    console.log(id_tna);
    console.log(id_user);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_kadiv",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            id_user: id_user
        },
        success: function(data) {
            window.location.reload()

        }

    })

})

// //for reject tna
// $("#btn-reject").on('click', function() {
//     var id_tna = $('#tna').val();
//     var id_user = $('#user').val();
//     console.log(id_tna);
//     console.log(id_user);
//     $.ajax({
//         type: 'post',
//         url: "<?= base_url(); ?>/reject_kadiv",
//         async: true,
//         dataType: "json",
//         data: {
//             id_tna: id_tna,
//             id_user: id_user
//         },
//         success: function(data) {
//             window.location.reload()

//         }

//     })

// })
</script>