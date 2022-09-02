<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto">
            <thead></thead>
            <tr>
                <th>Nama</th>
                <th>Training</th>
                <th>Jenis Training</th>
                <th>Kategori Training</th>
                <th>Metode Training</th>
                <th>Rencana Training</th>
                <th>Tujuan Training</th>
                <th>Notes</th>
                <th>Estimasi Budget</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($status as $statuses) : ?>
                <tr>
                    <td><?= $statuses['nama'] ?></td>
                    <td><?= $statuses['training'] ?></td>
                    <td><?= $statuses['jenis_training'] ?></td>
                    <td><?= $statuses['kategori_training'] ?></td>
                    <td><?= $statuses['metode_training'] ?></td>
                    <td><?= $statuses['rencana_training'] ?></td>
                    <td><?= $statuses['tujuan_training'] ?></td>
                    <td><?= $statuses['notes'] ?></td>
                    <td><?= $statuses['biaya_actual'] ?></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm " style="width:100px;" id="kadiv-accept"><i
                                class="fa fa-fw fa-check"></i>Accept</button>
                        <input type="hidden" id="tna" value="<?= $statuses['id_tna'] ?>">
                        <input type="hidden" id="user" value="<?= $statuses['id_user'] ?>">
                        <button type="button" class="btn btn-danger btn-sm mt-1 " style="width:100px;"
                            id="btn-reject"><i class="fa fa-fw fa-close"></i>Reject</button>
                        <input type="hidden" id="reject" value="<?= $statuses['id_tna'] ?>">
                        <input type="hidden" id="user" value="<?= $statuses['id_user'] ?>">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
//for change TNA 
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

//for reject tna
$("#btn-reject").on('click', function() {
    var id_tna = $('#tna').val();
    var id_user = $('#user').val();
    console.log(id_tna);
    console.log(id_user);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_kadiv",
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
</script>
<?= $this->endSection() ?>