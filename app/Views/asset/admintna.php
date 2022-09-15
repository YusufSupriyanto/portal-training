<script>
$('#tna-admin').on('click', '.item-edit', function() {
    var id_tna = $(this).attr('data');
    console.log(id_tna);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/detail_tna",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna
        },
        success: function(data) {
            console.log(data)
            jQuery.noConflict()
            $("#exampleModal").modal("show");
            $('[name = "nama"]').val(data[0].nama)
            $('[name = "dic"]').val(data[0].dic)
            $('[name = "divisi"]').val(data[0].divisi)
            $('[name = "departemen"]').val(data[0].departemen)
            $('[name = "training"]').val(data[0].training)
            $('[name = "jenis-training"]').val(data[0].jenis_training)
            $('[name = "kategori-training"]').val(data[0].kategori_training)
            $('[name = "metode-training"]').val(data[0].metode_training)
            $('[name = "rencana-training"]').val(data[0].rencana_training)
            $('[name = "tujuan-training"]').val(data[0].tujuan_training)
            $('[name = "notes"]').val(data[0].notes)
            $('[name = "budget"]').val(data[0].biaya)
        }

    })
})

function Accept(i) {
    var id_tna = $('#accept' + i).attr('data-accept');
    var biaya_actual = $('#biaya' + i).val()
    var rencana_training = $('#rencana-training' + i).val()
    var vendor = $('#vendor' + i).val()
    console.log(biaya_actual)
    console.log(rencana_training)
    console.log(id_tna)
    console.log(vendor)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_admin",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            biaya_actual: biaya_actual,
            rencana_training: rencana_training,
            vendor: vendor
        },
        success: function(data) {
            window.location.reload()

        }

    })

}


function Reject(i) {
    var id_tna = $('#reject' + i).attr('data-reject');
    var biaya_actual = $('#biaya' + i).val()
    var rencana_training = $('#rencana-training' + i).val()
    console.log(biaya_actual)
    console.log(rencana_training)
    console.log(id_tna)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_admin",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            biaya_actual: biaya_actual,
            rencana_training: rencana_training
        },
        success: function(data) {
            window.location.reload()

        }

    })
}


$('#status-kadiv').on('click', '.item-edit', function() {
    var id_tna = $(this).attr('data-reject');
    console.log(id_tna);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/detail_reject",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna
        },
        success: function(data) {
            console.log(data)
            jQuery.noConflict()
            $("#detail-reject").modal("show");
            $('[name = "alasan"]').val(data.alasan)
            // window.location.reload()
        }

    })
})


function AcceptAdmin(i) {
    var id_tna = $('#acceptadmin' + i).attr('data-acceptadmin');
    var biaya_actual = $('#biaya' + i).val()
    var rencana_training = $('#rencana-training' + i).val()
    console.log(biaya_actual)
    console.log(rencana_training)
    console.log(id_tna)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_adminfixed",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            biaya_actual: biaya_actual,
            rencana_training: rencana_training
        },
        success: function(data) {
            window.location.reload()

        }

    })

}


// $('#admin-verify').on('click', '.admin-verify', function() {
//     var id_tna = $(this).attr('data-reject-admin');
//     console.log(id_tna);
//     jQuery.noConflict()
//     $("#rejectAdmin").modal("show");
// })

function verify_admin(i) {
    var id_tna = $('#acceptadmin' + i).attr('data-acceptadmin');
    console.log(id_tna);
    jQuery.noConflict()
    $("#rejectAdmin" + i).modal("show");
}


function Reject_Admin(i) {
    var id_tna = $('#reject-admin-input' + i).val();
    const alasan = $('#alasan' + i).val()
    var biaya_actual = $('#biaya' + i).val()
    console.log(id_tna);
    console.log(alasan);
    console.log(biaya_actual)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_adminfixed",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            alasan: alasan,
            biaya_actual: biaya_actual
        },
        success: function(data) {
            window.location.reload()

        }
    })

}
</script>