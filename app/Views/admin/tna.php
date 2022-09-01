<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Daftar Tna</h3>
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
                <?php foreach ($tna as $tnas) : ?>
                <tr>
                    <td><input value="<?= $tnas->nama ?>"></td>
                    <td><input value="<?= $tnas->departemen ?>"></td>
                    <td><input value="<?= $tnas->golongan ?>"></td>
                    <td><input value="<?= $tnas->seksi ?>"></td>
                    <td><input value="<?= $tnas->jenis_training ?>"></td>
                    <td><input value="<?= $tnas->kategori_training ?>"></td>
                    <td><input value="<?= $tnas->training ?>"></td>
                    <td><input value="<?= $tnas->metode_training ?>"></td>
                    <td><input value="<?= $tnas->rencana_training ?>"></td>
                    <td><input value="<?= $tnas->tujuan_training ?>"></td>
                    <td><input value="<?= $tnas->biaya ?>"></td>
                    <td><input id="biaya"></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm " style="width:100px;" id="btn-accept"><i
                                class="fa fa-fw fa-check"></i>Accept</button>
                        <input type="hidden" id="accept" value="<?= $tnas->id_tna ?>">
                        <form action="<?= base_url() ?>/reject_admin/<?= $tnas->id_tna  ?>">
                            <button class="btn btn-danger btn-sm mt-1" style="width:100px;"><i
                                    class="fa fa-fw fa-close"></i>Rejected</button>
                        </form>
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