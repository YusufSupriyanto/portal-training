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
                        <div class="d-flex flex-row">
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm "><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.card-body -->

<script>
var id_tna = $('#tna').val();
var id_user = $('#user').val();

$.ajax({
    type: 'post',
    url: "<?= base_url(); ?>/tna_user_status",
    async: true,
    dataType: "json",
    data: {
        id_tna: id_tna,
        id_user: id_user
    },
    success: function(data) {

    }

})
</script>
<?= $this->endSection() ?>