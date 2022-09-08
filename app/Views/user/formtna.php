<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-3 overflow-auto">
    <div class="card-header d-flex justify-content-center">
        <h3 class="card-title"><?= $tittle  ?></h3>
    </div>
    <form method="post" action="" id="form-tna">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile overflow-auto">
                <div class="card overflow-auto">
                    <div class="card-body p-1 m-1" style=" position:absolute;width:auto;">
                        <h6>Nama :<?= "  " . $user['nama'] ?></h6>
                        <h6>Jabatan :<?= "  " . $user['bagian'] ?></h6>
                        <h6>Departemen :<?= "  " . $user['departemen'] ?></h6>
                        <h6>Seksi :<?= "  " . $user['seksi'] ?></h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body  p-0" style="margin-top:150px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Training</th>
                                    <th>Jenis Training</th>
                                    <th>Kategori Training</th>
                                    <th>Metode Training</th>
                                    <th>Rencana Training</th>
                                    <th>Tujuan Training</th>
                                    <th>Notes</th>
                                    <th>Estimasi Budget</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <select class="custom-select" name="training" id="training"
                                            style="width:300px;">
                                            <option selected>Choose...</option>
                                            <?php foreach ($training as $trainings) : ?>
                                            <option value="<?= $trainings->id_training ?>">
                                                <?= $trainings->judul_training ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <div id="jenis_training"></div>
                                    </td>
                                    <td>
                                        <select class="custom-select" name="kategori" id="kategori"
                                            style="width:100px;">
                                            <option value="">Choose</option>
                                            <option value="Internal">Internal</option>
                                            <option value="External">External</option>
                                            <option value="Inhouse">Inhouse</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="custom-select" name="metode" id="metode" style="width:100px;">
                                            <option value="">Choose</option>
                                            <option value="Online">Online</option>
                                            <option value="Offline">Offline</option>
                                            <option value="Keduanya">Antara Keduanya</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="datepicker custom-select" data-date-format="
                                            mm-dd-yyyy" name="rencana" type="date">
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?> "
                                            id="validationTextarea" placeholder="Required example textarea" required
                                            name="tujuan" style="width:300px;"></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tujuan'); ?>
                                        </div>
                                    </td>
                                    <td><textarea class="form-control" name=" notes" placeholder="Permintaan Khusus "
                                            style="width:300px;"></textarea></textarea>
                                    </td>
                                    <td>
                                        <h5 id="biaya"></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card-footer clearfix d-flex justify-content-end">
            <button class="btn btn-primary "><i class="fa fa-fw fa-save"></i></button>
        </div>
    </form>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Form TNA</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Training</th>
                        <th>Jenis Training</th>
                        <th>Kategori Training</th>
                        <th>Metode Training</th>
                        <th>Rencana Training</th>
                        <th>Tujuan Training</th>
                        <th>Notes</th>
                        <th>Estimasi Budget</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tna as $Forms) : ?>
                    <tr>
                        <td><?= $Forms->training ?></td>
                        <td><?= $Forms->jenis_training ?></td>
                        <td><?= $Forms->kategori_training ?></td>
                        <td><?= $Forms->metode_training ?></td>
                        <td><?= $Forms->rencana_training ?></td>
                        <td><?= $Forms->tujuan_training ?></td>
                        <td><?= $Forms->notes ?></td>
                        <td>Rp.<?= $Forms->biaya ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <button class="btn btn"></button>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<script>
$(function() {
    $('#datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
    });
});


//for change TNA 
$("#training").on('change', function() {
    var id_training = this.value;
    console.log(id_training);

    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/User/FormTna",
        async: true,
        dataType: "json",
        data: {
            id_training: id_training
        },
        success: function(data) {


            console.log(data.jenis_training);


            $("#jenis_training").html(
                `<span>${data.jenis_training}</span>`
            );

            $("#biaya").html(
                `<span>RP.${data.biaya}</span>`
            );
            $("#form-tna").attr('action',
                '<?= base_url() ?>/tna/form/<?= $user['id_user']  ?>/' + data.id_training);
        }

    })
})
</script>
<?= $this->endSection() ?>