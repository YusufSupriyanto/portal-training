<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="m-1">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $category ?></h3>
                <div class="card-tools d-flex">
                    <div>
                        <form action="<?= base_url() ?>/import" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append"></div>
                                <button type="submit" class="input-group-text" id="">Upload</button>
                            </div>
                        </form>
                    </div>
                    <div class="ml-2">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#exampleModalLong">
                            <i class="fa fa-plus"></i>Add Training
                        </button>
                    </div>
                    <div class="ml-2">
                        <form action="<?= base_url() ?>/delete_all" method="post">
                            <button class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i>
                                Delete All</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed display" id="example2">
                <thead>
                    <tr>
                        <th>Judul Training</th>
                        <th>Jenis Training</th>
                        <th>Deskripsi</th>
                        <th>Vendor</th>
                        <th>Biaya</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jenis as $trainings) : ?>
                    <tr>
                        <td><?= $trainings->judul_training ?></td>
                        <td><?= $trainings->jenis_training ?></td>
                        <td><?= $trainings->deskripsi ?></td>
                        <td><?= $trainings->vendor ?></td>
                        <td><?= "Rp " . number_format($trainings->biaya, 0, ',', '.') ?></td>
                        <td>
                            <div class="d-flex">
                                <form action="<?= base_url() ?>/delete_training" method="POST">
                                    <input type="hidden" value="<?= $category ?>" name="category">
                                    <input type="hidden" value="<?= $trainings->id_training ?>" name="id">
                                    <button class="btn btn-danger btn-sm btn-delete"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                                <div class="ml-2">
                                    <input type="hidden" value="<?= $trainings->id_training ?>" name="id">
                                    <button class="btn btn-warning btn-sm"
                                        onclick="edit('<?= $trainings->id_training ?>','<?= $trainings->judul_training ?>','<?= $trainings->jenis_training ?>','<?= $trainings->deskripsi ?>','<?= $trainings->vendor ?>','<?= $trainings->biaya ?>')"><i
                                            class="fa-solid fa-pen-to-square"></i></button>

                                </div>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <!-- form start -->

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Training</label>
                            <input type="text" class="form-control" name="add" placeholder="Masukan Judul">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Training</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="Jenis Training" name="add" value="<?= $category ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vendor</label>
                            <input type="text" class="form-control" name="add" placeholder="Masukan Vendor">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Biaya</label>
                            <input type="text" class="form-control" id="biaya" name="add" placeholder="Biaya"
                                onclick="formatted()">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="sendTraining()">Submit</button>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="edit[]" id="id" ">
                            <label for=" exampleInputEmail1">Judul Training</label>
                            <input type="text" class="form-control" name="edit[]" id="judul"
                                placeholder="Masukan Judul">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Training</label>
                            <input type="text" class="form-control" placeholder="Jenis Training" name="edit[]"
                                id="jenis">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="edit[]"
                                id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vendor</label>
                            <input type="text" class="form-control" name="edit[]" placeholder="Masukan Vendor"
                                id="vendor">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Biaya</label>
                            <input type="text" class="form-control" id="biayaedit" name="edit[]" placeholder="Biaya"
                                onclick="formattedEdit()">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="sendEditTraining()">Submit</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function formatted() {
    new AutoNumeric('#biaya', {
        decimalPlaces: 0,
        decimalCharacter: ',',
        digitGroupSeparator: '.',
    });
}

function formattedEdit() {
    new AutoNumeric('#biayaedit', {
        decimalPlaces: 0,
        decimalCharacter: ',',
        digitGroupSeparator: '.',
    });
}

function edit(id, judul, jenis, deskripsi, vendor, biaya) {
    jQuery.noConflict();
    $('#editTraining #id').val(id);
    $('#editTraining #judul').val(judul);
    $('#editTraining #jenis').val(jenis);
    $('#editTraining #deskripsi').val(deskripsi);
    $('#editTraining #vendor').val(vendor);
    $('#editTraining #biayaedit').val(biaya);
    $('#editTraining').modal('show');

}

function sendTraining() {
    let add = $("input[name='add']").map(function() {
        return $(this).val();
    }).get();
    //  console.log(add)
    if (add[0] == '' || add[0] == "" || add[1] == '' || add[1] == "" || add[2] == '' || add[2] == "" || add[3] == '' ||
        add[3] == "") {
        add = []
    } else {
        $.ajax({
            type: 'POST',
            url: "<?= base_url(); ?>/save_training",
            async: true,
            dataType: "json",
            data: {
                add: add,

            },
            success: function(data) {
                window.location.reload()
                //console.log(data)
            }
        })

    }

}

function sendEditTraining() {
    let id = $("#editTraining #id").val();
    let judul = $("#editTraining #judul").val();
    let jenis = $("#editTraining #jenis").val();
    let deskripsi = $("#editTraining #deskripsi").val();
    let vendor = $("#editTraining #vendor").val();
    let biayaedit = $("#editTraining #biayaedit").val();
    console.log(deskripsi)
    if (id == '' || judul == '' || jenis == '' || deskripsi == '' || vendor == '' || biayaedit == '') {
        add = []
    } else {
        $.ajax({
            type: 'POST',
            url: "<?= base_url(); ?>/edit_training",
            async: true,
            dataType: "json",
            data: {
                id: id,
                judul: judul,
                jenis: jenis,
                deskripsi: deskripsi,
                vendor: vendor,
                biaya: biayaedit
            },
            success: function(data) {
                window.location.reload()
                //console.log(data)
            }
        })

    }
}
</script>
<?= $this->endSection() ?>