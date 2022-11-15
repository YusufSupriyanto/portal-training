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
            //  jQuery.noConflict()
            window.location.reload()
            //console.log(data)

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
    var alasan = $('#alasan' + i).val()
    console.log(id_tna);
    console.log(alasan);
    if (alasan == "") {

        $('#alasan' + i).attr('required', true)

    } else {
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
                //console.log(data)
            }

        })
    }

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
            // jQuery.noConflict()
            window.location.reload()
            //console.log(data)
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
    var alasan = $('#alasan' + i).val()
    var id_tna = $('#accept-bod-input' + i).val();
    console.log(id_tna);
    console.log(alasan);
    if (alasan == "") {
        $('#alasan' + i).attr('required', true)
    } else {
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
                //console.log(data)

            }

        })

    }



}
</script>