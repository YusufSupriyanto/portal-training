<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<!-- Modal -->
<div class="modal fade" id="CompetencyUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Competency User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>/change_competency" method="POST">
                <div class="modal-body">
                    <div id="competency"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-1">
    <div class="card-header">
        <!-- <h3 class="card-title">User</h3> -->
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>

            <div>
                <form action="<?= base_url() ?>/addUser" method="post" enctype="multipart/form-data">
                    <div class="input-group">

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="multipleInputFile" name="file">
                            <label class="custom-file-label" for="multipleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append"></div>
                        <button type="submit" class="input-group-text" id="">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="user-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>DIC</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Member</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->nama ?></td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->dic ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->seksi ?></td>
                    <td><?= $users->bagian ?></td>
                    <td>
                        <div class="column">
                            <form action="<?= base_url() ?>\delete\user\<?= $users->id_user ?>" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm btn-delete"><i
                                        class="fa fa-fw fa-trash"></i></button>
                            </form>
                            <form action="<?= base_url() ?>\update_user" method="post">
                                <input type="hidden" name="update" value="<?= $users->id_user ?>">
                                <button type="submit" class="btn btn-warning btn-sm mt-2"><i
                                        class="fa-solid fa-pen-to-square" style="font-size:17px;"></i></button>
                            </form>
                            <button class="btn btn-success btn-sm mt-2" onclick="Competency(<?= $users->id_user ?>)"><i
                                    class="fa-solid fa-trophy" style="font-size:17px;"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url() ?>/save_user" method="post" enctype="multipart/form-data">
                    <div class="card card-primary">
                        <!-- form start -->

                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <div>Form User</div>
                                <div class="form-group"></div>
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NPK</label>
                                <input type="text" name="npk" class="form-control" placeholder="Masukan Npk" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <input type="text" name="status" class="form-control" placeholder="Masukan Status"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Dic</label>
                                <select class="custom-select" name="dic" required>
                                    <option>Choose</option>
                                    <?php foreach ($DIC as $dic) : ?>
                                    <option value="<?= $dic['dic'] ?>"><?= $dic['dic']  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="custom-select" name="divisi" required>
                                    <option>Choose</option>
                                    <?php foreach ($DIVISI as $div) : ?>
                                    <option value="<?= $div['divisi'] ?>"><?= $div['divisi']  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="custom-select" name="departemen" required>
                                    <option>Choose</option>
                                    <?php foreach ($DEPARTEMEN as $dept) : ?>
                                    <option value="<?= $dept['departemen'] ?>"><?= $dept['departemen'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select class="custom-select" name="seksi" required>
                                    <option>Choose</option>
                                    <?php foreach ($SEKSI as $seksi) : ?>
                                    <option value="<?= $seksi['seksi'] ?>"><?= $seksi['seksi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Member</label>
                                <select class="custom-select" name="bagian" required>
                                    <option>Choose</option>
                                    <?php foreach ($BAGIAN as $bagian) : ?>
                                    <option value="<?= $bagian['bagian'] ?>"><?= $bagian['bagian'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Position Name</label>
                                <select class="custom-select" name="jabatan" required>
                                    <option>Choose</option>
                                    <?php foreach ($JABATAN as $jabatan) : ?>
                                    <option value="<?= $jabatan['nama_jabatan'] ?>"><?= $jabatan['nama_jabatan'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select class="custom-select" name="level" required>
                                    <option>Choose</option>
                                    <option value="USER">USER</option>
                                    <option value="ADMIN">ADMIN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukan Password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="singleInputFile">Input Profile</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="singleInputFile">
                                        <label class="custom-file-label" for="singleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>Form Education</div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Grade</label>
                                <input type="text" name="grade" class="form-control" placeholder="Masukan Grade">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Year</label>
                                <input type="text" name="year" class="form-control" placeholder="Masukan Year">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Institution</label>
                                <input type="text" name="institution" class="form-control"
                                    placeholder="Masukan Institution">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Major</label>
                                <input type="text" name="major" class="form-control" placeholder="Masukan Major">
                            </div>
                            <div>Form Career</div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Year Start</label>
                                <input type="text" name="year_start" class="form-control"
                                    placeholder="Masukan Year Start">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Year End</label>
                                <input type="text" name="year_end" class="form-control" placeholder="Masukan Year End">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Position</label>
                                <input type="text" name="position" class="form-control" placeholder="Masukan Position">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                <input type="text" name="department" class="form-control"
                                    placeholder="Masukan Department">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Division</label>
                                <input type="text" name="division" class="form-control" placeholder="Masukan Division">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Company</label>
                                <input type="text" name="company" class="form-control" placeholder="Masukan Company">
                            </div>
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control" name="group">
                                    <option>Choose...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type User</label>
                                <select class="form-control" name="type_user">
                                    <option>Choose...</option>
                                    <option value="REGULAR">REGULAR</option>
                                    <option value="EXPERT">EXPERT</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= base_url() ?>/add_education">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Grade</label>
                        <input type="text" name="grade" class="form-control" placeholder="Masukan Grade" required>
                        <input type="hidden" name="id" id="id" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Year</label>
                        <input type="text" name="year" class="form-control" placeholder="Masukan Year" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Institution</label>
                        <input type="text" name="institution" class="form-control" placeholder="Masukan Institution"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Major</label>
                        <input type="text" name="major" class="form-control" placeholder="Masukan Major" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="career" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= base_url() ?>/add_career">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Year Start</label>
                        <input type="text" name="year_start" class="form-control" placeholder="Masukan Year Start"
                            required>
                        <input type="hidden" name="id" id="id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Year End</label>
                        <input type="text" name="year_end" class="form-control" placeholder="Masukan Year End">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Position</label>
                        <input type="text" name="position" class="form-control" placeholder="Masukan Position" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Department</label>
                        <input type="text" name="department" class="form-control" placeholder="Masukan Department"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Division</label>
                        <input type="text" name="division" class="form-control" placeholder="Masukan Division" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Company</label>
                        <input type="text" name="company" class="form-control" placeholder="Masukan Company" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
function education(id) {
    // alert(id)
    jQuery.noConflict();
    $('#education #id').val(id)
    $("#education").modal("show");
}

function career(id) {
    // alert(id)
    jQuery.noConflict();
    $('#career #id').val(id)
    $("#career").modal("show");
}


function Competency(id) {
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/competency_user",
        // async: true,
        dataType: "text",
        data: {
            id: id
        },
        success: function(data) {
            console.log(data)
            jQuery.noConflict();
            $('#competency').html(data)
            $('#CompetencyUser').modal('show')


        }

    })
}
</script>
<?= $this->endSection() ?>