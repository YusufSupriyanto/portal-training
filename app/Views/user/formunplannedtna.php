<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-1 overflow-auto">
    <div class="card-header d-flex justify-content-center">
        <h3 class="card-title"><?= $tittle  ?></h3>

    </div>
    <!-- form -->
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#terdaftar">
                    Registered Unplanned
                </button>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                    History Unplanned
                </button>
                <h6><input class="form-control" value="Nama                  :<?= "  " . $user['nama'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Jabatan               :<?= "  " . $user['bagian'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Departemen        :<?= "  " . $user['departemen'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Seksi                   :<?= "  " . $user['seksi'] ?>" readonly>
                </h6>
            </h3>
            <div class="card">
                <div class="card">
                    <?php if (!empty($astra)) : ?>
                    <div class="card-header">
                        <h3 class="card-title">Asrtra Leadership Competency</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($astra as $Astra) : ?>
                                <tr>
                                    <td><?= $Astra['competency'] ?></td>
                                    <td><?= $Astra['proficiency'] ?></td>
                                    <td><?= $Astra['score'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Technical Competency</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($technical as $Technical) : ?>
                                <tr>
                                    <td><?= $Technical['competency'] ?></td>
                                    <td><?= $Technical['proficiency'] ?></td>
                                    <td><?= $Technical['score'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php elseif (!empty($expert)) : ?>
                    <div class="card-header">
                        <h3 class="card-title">Expert Behavior Competencies</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($expert as $Expert) : ?>
                                <tr>
                                    <td><?= $Expert['competency'] ?></td>
                                    <td><?= $Expert['proficiency'] ?></td>
                                    <td><?= $Expert['score'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Technical Competency</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($technical as $Technical) : ?>
                                <tr>
                                    <td><?= $Technical['competency'] ?></td>
                                    <td><?= $Technical['proficiency'] ?></td>
                                    <td><?= $Technical['score'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else : ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Soft Competency</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Competency</th>
                                        <th>Proficiency</th>
                                        <th>Score</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($soft as $Soft) : ?>
                                    <tr>
                                        <td><?= $Soft['competency'] ?></td>
                                        <td><?= $Soft['proficiency'] ?></td>
                                        <td><?= $Soft['score'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Technical Competency</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Competency</th>
                                            <th>Proficiency</th>
                                            <th>Score</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($technicalB as $TechnicalB) : ?>
                                        <tr>
                                            <td><?= $TechnicalB['competency'] ?></td>
                                            <td><?= $TechnicalB['proficiency'] ?></td>
                                            <td><?= $TechnicalB['score'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Company Competency</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Competency</th>
                                                <th>Proficiency</th>
                                                <th>Score</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($company as $Company) : ?>
                                            <tr>
                                                <td><?= $Company['competency'] ?></td>
                                                <td><?= $Company['proficiency'] ?></td>
                                                <td><?= $Company['score'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endif; ?>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>/unplanned_save" method="post" id="form-tna">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="role" name="role">
                                <label>Target Competency<span style="color:red;">*</span></label>
                                <select class="js-example-basic-single form-control" name="kompetensi" id="kompetensi">
                                    <option selected></option>
                                    <?php foreach ($target as $competency) : ?>
                                    <option value="<?= $competency['id'] ?>,<?= $competency['keterangan'] ?>">
                                        <?= $competency['category'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="<?= $user['id_user'] ?>" name="id_user">
                                <input type="hidden" value="<?= 1; ?>" name="deadline">
                                <label>Training<span style="color:red;">*</span></label>
                                <input type="hidden" name="trainingunplanned" id="trainingunplanned">
                                <select class="form-control" name="training" id="training" readonly>
                                    <option selected>
                                        <?= $training ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_training">Jenis Training<span style="color:red;">*</span></label>
                                <input class="form-control" id="jenis_training" name="jenis_training" readonly
                                    value="<?= $jenis ?>">
                                <input type="hidden" id="id_training" name="id_training" readonly
                                    value="<?= $id_training ?>">
                            </div>
                            <div class="form-group">
                                <label>Kategori Training<span style="color:red;">*</span></label>
                                <select class="form-control" name="kategori" id="kategori" readonly>
                                    <option selected value="<?= $kategori ?>">
                                        <?= $kategori ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Metode<span style="color:red;">*</span></label>
                                <select class="custom-select" name="metode" id="metode" readonly>
                                    <option selected>
                                        <?= $metode ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Start Training<span style="color:red;">*</span></label>
                                <input class="datepicker custom-select" data-date-format="
                                            mm-dd-yyyy" name="rencanaFirst" type="date" id="dateFirst"
                                    value="<?= $start ?>" readonly>

                            </div>
                            <div class="form-group">
                                <label for="date">End Training<span style="color:red;">*</span></label>
                                <input class="datepicker custom-select" data-date-format="
                                            mm-dd-yyyy" name="rencana" type="date" id="date" value="<?= $end ?>"
                                    readonly>
                                <div class="form-group">
                                    <label>Tujuan<span style="color:red;">*</span></label>
                                    <textarea
                                        class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?> "
                                        id="validationTextarea" placeholder="Required example textarea" required
                                        name="tujuan"></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tujuan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" name=" notes"
                                        placeholder="Permintaan Khusus"></textarea></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="budget">Budget<span style="color:red;">*</span></label>
                                    <input class="form-control" readonly
                                        value="<?= "Rp " . number_format((int)$budget, 0, ',', '.') ?>">
                                    <input type="hidden" id="budget" name="budget" value="<?= $budget ?>">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                            </div>
                    </form>
                </div>
                <!-- endform -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">History Unplanned Training</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>Training</th>
                                            <th>Jenis Training</th>
                                            <th>Kategori Training</th>
                                            <th>Metode Training</th>
                                            <th>Start Training</th>
                                            <th>End Training</th>
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
                                            <td><?= $Forms->mulai_training ?></td>
                                            <td><?= $Forms->rencana_training ?></td>
                                            <td><?= $Forms->tujuan_training ?></td>
                                            <td><?= $Forms->notes ?></td>
                                            <td>Rp<?= " " . number_format($Forms->biaya, 0, ',', '.')  ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="terdaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Unplanned Training Terdaftar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>Training</th>
                                            <th>Jenis Training</th>
                                            <th>Kategori Training</th>
                                            <th>Metode Training</th>
                                            <th>Start Training</th>
                                            <th>End Training</th>
                                            <th>Tujuan Training</th>
                                            <th>Notes</th>
                                            <th>Estimasi Budget</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($terdaftar as $Forms) : ?>
                                        <tr>
                                            <td><?= $Forms->training ?></td>
                                            <td><?= $Forms->jenis_training ?></td>
                                            <td><?= $Forms->kategori_training ?></td>
                                            <td><?= $Forms->metode_training ?></td>
                                            <td><?= $Forms->mulai_training ?></td>
                                            <td><?= $Forms->rencana_training ?></td>
                                            <td><?= $Forms->tujuan_training ?></td>
                                            <td><?= $Forms->notes ?></td>
                                            <td>Rp<?= " " . number_format($Forms->biaya, 0, ',', '.')  ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.js-example-basic-single').select2();
$("#datepicker").datepicker({
    format: "M-yyyy",
    startView: "months",
    minViewMode: "months"
});
let data = $('#data').val()
if (data != null) {
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/User/FormTna",
        async: true,
        dataType: "json",
        data: {
            id_training: data
        },
        success: function(data) {


            console.log(data);

            const format = data.biaya.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            const rupiah = 'Rp ' + convert.join('.').split('').reverse().join('')
            $("#training").val(data.id_training).prop(
                'readonly', true)
            $("#trainingunplanned").val(data.id_training)
            $("#jenis_training").val(data.jenis_training)


            $("#biaya").val(rupiah)
        }

    })

}
</script>
<?= $this->endSection() ?>