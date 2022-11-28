<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<style>
.images {
    width: 200px;
    height: 230px;
}
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Individual Profile</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="images" src="<?= base_url() . $person['profile'] ?>"
                                    alt="User profile picture">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm m-2" data-toggle="modal"
                            data-target="#edit">
                            <i class="fa-solid fa-user-pen"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm m-2" data-toggle="modal"
                            data-target="#education">
                            <i class="fa-solid fa-graduation-cap"></i> Education
                        </button>
                        <button type="button" class="btn btn-warning btn-sm m-2" data-toggle="modal"
                            data-target="#career">
                            <i class="fa-solid fa-clock-rotate-left"></i> History Career
                        </button>
                        <button type="button" class="btn btn-success btn-sm m-2"
                            onclick="Competency(<?= session()->get('id'); ?>)">
                            <i class="fa-solid fa-award"></i> Kompetensi Profile
                        </button>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane active" id="settings">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName"
                                            value="<?= $person['nama'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Npk</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail"
                                            value="<?= $person['npk'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Departemen</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2"
                                            value="<?= $person['departemen'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2"
                                            value="<?= $person['divisi'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Seksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills"
                                            value="<?= $person['seksi'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Golongan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills"
                                            value="<?= $person['golongan'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Promosi Terakhir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills"
                                            value="<?= $person['promosi_terakhir'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Masa Kerja</label>
                                    <div class="d-flex">
                                        <div class="col-sm-10 d-flex">
                                            <input type="text" class="form-control" id="inputSkills"
                                                value="<?= $person['tahun'] ?>" disabled>
                                            <label class="m-2">Tahun</label>
                                            <input type="text" class="form-control" id="inputSkills"
                                                value="<?= $person['bulan'] ?>" disabled>
                                            <label class="m-2">Bulan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class=" card-title">Education</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Grade</th>
                                    <th>Year</th>
                                    <th>Institution</th>
                                    <th>Major</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($education as $educations) : ?>
                                <tr>
                                    <td><?= $educations['grade'] ?></td>
                                    <td><?= $educations['year'] ?></td>
                                    <td><?= $educations['institution'] ?></td>
                                    <td><?= $educations['major'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="career" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class=" card-title">History Career</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Year Start</th>
                                    <th>Year End</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Division</th>
                                    <th>Company</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($career as $careers) : ?>
                                <tr>
                                    <td><?= $careers['year_start'] ?></td>
                                    <td><?= $careers['year_end'] ?></td>
                                    <td><?= $careers['position'] ?></td>
                                    <td><?= $careers['departement'] ?></td>
                                    <td><?= $careers['division'] ?></td>
                                    <td><?= $careers['company'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form role="form" action="<?= base_url() ?>/change_profile" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Choose Photo</label>
                        <input type="file" name="foto" id="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="competency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CompetencyTable"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function Competency(id) {
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/competency_profile",
        // async: true,
        dataType: "text",
        data: {
            id: id
        },
        success: function(data) {
            console.log(data)
            jQuery.noConflict();
            $('#CompetencyTable').html(data)
            $('#competency').modal('show');
        }
    })
}
</script>
<?= $this->endSection() ?>