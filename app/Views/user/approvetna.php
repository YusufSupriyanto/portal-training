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
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Golongan</th>
                    <th>Seksi</th>
                    <th>Jenis Training</th>
                    <th>Kategori Training</th>
                    <th>Training</th>
                    <th>Metode</th>
                    <th>Rencana Training</th>
                    <th>Tujuan Training</th>
                    <th>Planing Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
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