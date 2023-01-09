<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Group</th>
                    <th>Section</th>
                    <th>Training Type</th>
                    <th>Training Category</th>
                    <th>Training</th>
                    <th>Method</th>
                    <th>Training Implemented</th>
                    <th>Training Goals</th>
                    <th>Planing Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
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
    <!-- /.card-body -->
</div>
<script>
//for change TNA 
$("#btn-accept").on('click', function() {
    var id_tna = $('#accept').val();
    var biaya_actual = $('#biaya').val();
    console.log(id_tna);
    console.log(biaya_actual);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/accept_admin",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            biaya_actual: biaya_actual
        },
        success: function(data) {

        }

    })
})
</script>
<?= $this->endSection() ?>