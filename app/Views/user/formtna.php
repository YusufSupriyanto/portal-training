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
                    Training Registered
                </button>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                    Training History
                </button>
                <h6><input class="form-control" value="Nama                  :<?= "  " . $user['nama'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Jabatan               :<?= "  " . $user['bagian'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Departemen       :<?= "  " . $user['departemen'] ?>" readonly>
                </h6>
                <h6><input class="form-control" value="Seksi                   :<?= "  " . $user['seksi'] ?>" readonly>
                </h6>
            </h3>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Company General Competency</h3>
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
                            <?php endif; ?>
                            <!-- /.card-body -->
                        </div>
                        <!-- form start -->
                        <form role="form" action="<?= base_url() ?>/save_form" method="post" id="form-tna">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" id="role" name="role">
                                    <label>Target Competency<span style="color:red;">*</span></label>
                                    <select class=" js-example-basic-single form-control" name="kompetensi"
                                        id="kompetensi">
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
                                    <input type="hidden" value="<?= 0; ?>" name="deadline">
                                    <label>Training<span style="color:red;">*</span></label>
                                    <select class="js-example-basic-single form-control" name="training" id="training">
                                        <option selected></option>
                                        <?php foreach ($training as $trainings) : ?>
                                        <option value="<?= $trainings['id_training'] ?>">
                                            <?= $trainings['judul_training'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_training">Training Type<span style="color:red;">*</span></label>
                                    <input class="form-control" id="jenis_training" readonly></input>
                                </div>
                                <div class="form-group">
                                    <label>Training Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value="">Choose</option>
                                        <option value="Internal">Internal</option>
                                        <option value="External">External</option>
                                        <option value="Inhouse">Inhouse</option>
                                        <option value="Blended">Blended</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Method<span style="color:red;">*</span></label>
                                    <select class="custom-select" name="metode" id="metode">
                                        <option value="">Choose</option>
                                        <option value="Online">Online</option>
                                        <option value="Offline">Offline</option>
                                        <option value="Keduanya">Antara Keduanya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Training Request<span style="color:red;">*</span></label>
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" class="form-control" name="request">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Goals<span style="color:red;">*</span></label>
                                    <textarea class="form-control" id="validationTextarea"
                                        placeholder="Required example textarea" required name="tujuan"></textarea>

                                </div>
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" name=" notes"
                                        placeholder="Permintaan Khusus"></textarea></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="biaya">Budget Estimation<span style="color:red;">*</span></label>
                                    <input class="form-control" id="biaya" readonly></input>
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
                                    <h5 class="modal-title" id="exampleModalLabel">History Training</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>Training</th>
                                                <th>Training Type</th>
                                                <th>Training Category</th>
                                                <th>Training Method</th>
                                                <th>Training Start</th>
                                                <th>Training Finished</th>
                                                <th>Training Goals</th>
                                                <th>Notes</th>
                                                <th>Budget Estimation</th>
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
                    <!-- Modal -->
                    <div class="modal fade" id="terdaftar" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Training Registered</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped" id="mytable">
                                        <thead></thead>
                                        <tr>
                                            <th>Training</th>
                                            <th>Training Type</th>
                                            <th>Training Category</th>
                                            <th>Training Method</th>
                                            <th>Training Start</th>
                                            <th>Training Finished</th>
                                            <th>Training Goals</th>
                                            <th>Notes</th>
                                            <th>Budget Estimation</th>
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
</div>
<script>
$('.js-example-basic-single').select2();
$("#datepicker").datepicker({
    format: "M-yyyy",
    startView: "months",
    minViewMode: "months"
});
//for change kompetensi
$('#kompetensi').on('change', function() {
    var competency = this.value;
    console.log(competency);
})

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

            const format = data.biaya.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            const rupiah = 'Rp ' + convert.join('.').split('').reverse().join('')
            console.log(rupiah)

            $("#jenis_training").val(data.jenis_training)


            $("#biaya").val(rupiah)
        }

    })
})
</script>
<?= $this->endSection() ?>