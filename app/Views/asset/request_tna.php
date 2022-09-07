<script>
function AcceptKadiv(i) {
    var id_tna = $('#accept-kadiv-input' + i).val();
    console.log(id_tna)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_kadiv",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
        },
        success: function(data) {
            jQuery.noConflict()
            window.location.reload()

        }

    })

}

function Kadiv_verify(i) {
    var id_tna = $('#accept-kadiv-input' + i).val();
    console.log(id_tna);
    jQuery.noConflict()
    $("#rejectKadiv" + i).modal("show");

}

function reject_kadiv(i) {
    var id_tna = $('#reject-kadiv-input' + i).val();
    const alasan = $('#alasan' + i).val()
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

function AcceptBod(i) {
    var id_tna = $('#accept-bod-input' + i).val();
    console.log(id_tna)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_bod",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
        },
        success: function(data) {
            jQuery.noConflict()
            window.location.reload()

        }

    })

}

// bod verify


function verify_bod(i) {
    var id_tna = $('#accept-bod-input' + i).val();
    console.log(id_tna);
    jQuery.noConflict()
    $("#rejectBod" + i).modal("show");
}

function Reject_Bod(i) {
    const alasan = $('#alasan' + i).val()
    var id_tna = $('#accept-bod-input' + i).val();
    console.log(id_tna);
    console.log(alasan);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_bod",
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
</script>