<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3 " style="font-size:15px;">
    <div class="card-header h6">
        <h3 class="card-title">Daftar Training Need Analysis</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Training</th>
                    <th>rencana_training</th>
                    <th>Planing Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tna as $tnas) : ?>
                <tr>
                    <td><?= $tnas->nama ?></td>
                    <td><?= $tnas->departemen ?></td>
                    <td><?= $tnas->training ?></td>
                    <td><input value="<?= $tnas->rencana_training ?>"></td>
                    <td>Rp.<?= $tnas->biaya ?></td>

                    <td>
                        <div class="d-flex flex-row">
                            <label for="biaya" class="h6">Rp.</label>
                            <input type="text" id="biaya">
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm " style="width:100px;" id="btn-accept"><i
                                class="fa fa-fw fa-check"></i>Accept</button>
                        <input type="hidden" id="accept" value="<?= $tnas->id_tna ?>">
                        <button type="button" class="btn btn-danger btn-sm mt-1 " style="width:100px;"
                            id="btn-reject"><i class="fa fa-fw fa-close"></i>Reject</button>
                        <input type="hidden" id="reject" value="<?= $tnas->id_tna ?>">
                        <button id="btn-details" type="button" class="btn btn-primary  btn-sm mt-1" data-toggle="modal"
                            data-target="#exampleModal" style="width:100px;" value="<?= $tnas->id_tna ?>">
                            <i class=" fa fa-fw fa-file-text-o"></i>Detail
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Training Need Analysis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="nama" class="nama"></h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#btn-details").on('click', function() {
    var id_tna = $('#btn-details').val();
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
            // $(".modal-body #nama").val(data[0].nama);
            window.location.reload()
        }

    })
})
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
            window.location.reload()

        }

    })
})

//for reject tna
$("#btn-reject").on('click', function() {
    var id_tna = $('#reject').val();
    var biaya_actual = $('#biaya').val();
    console.log(id_tna);
    console.log(biaya_actual);
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/reject_admin",
        async: true,
        dataType: "json",
        data: {
            id_tna: id_tna,
            biaya_actual: biaya_actual
        },
        success: function(data) {
            window.location.reload()

        }

    })
})
</script>
<?= $this->endSection() ?>