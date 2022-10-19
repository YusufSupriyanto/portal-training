<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
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
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Seksi</th>
                    <th>Bagian</th>
                    <th>Status</th>
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
                    <td><?= $users->level ?></td>
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
                            <button type="button" class="btn btn-success btn-sm mt-2"
                                onclick="education(<?= $users->id_user ?>)">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm mt-2"
                                onclick="career(<?= $users->id_user ?>)">
                                <i class="fa-solid fa-briefcase" style="font-size:17px;"></i>
                            </button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
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
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Npk</label>
                                    <input type="text" name="npk" class="form-control" placeholder="Masukan Npk"
                                        required>
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
                                    <label>Departemen</label>
                                    <select class="custom-select" name="departemen" required>
                                        <option>Choose</option>
                                        <?php foreach ($DEPARTEMEN as $dept) : ?>
                                        <option value="<?= $dept['departemen'] ?>"><?= $dept['departemen'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seksi</label>
                                    <select class="custom-select" name="seksi" required>
                                        <option>Choose</option>
                                        <?php foreach ($SEKSI as $seksi) : ?>
                                        <option value="<?= $seksi['seksi'] ?>"><?= $seksi['seksi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bagian</label>
                                    <select class="custom-select" name="bagian" required>
                                        <option>Choose</option>
                                        <option value="BOD">BOD</option>
                                        <option value="KADIV">KADIV</option>
                                        <option value="KADEPT">KADEPT</option>
                                        <option value="KASIE">KASIE</option>
                                        <option value="STAFF 4UP">STAFF 4UP</option>
                                        <option value="STAFF">STAFF</option>
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
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Masukan Username" required>
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
                                    <label for="singleInputFile">Masukan Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input"
                                                id="singleInputFile" required>
                                            <label class="custom-file-label" for="singleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>Form Education</div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Grade</label>
                                    <input type="text" name="grade" class="form-control" placeholder="Masukan Grade"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Year</label>
                                    <input type="text" name="year" class="form-control" placeholder="Masukan Year"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Institution</label>
                                    <input type="text" name="institution" class="form-control"
                                        placeholder="Masukan Institution" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Major</label>
                                    <input type="text" name="major" class="form-control" placeholder="Masukan Major"
                                        required>
                                </div>
                                <div>Form Career</div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Year Start</label>
                                    <input type="text" name="year_start" class="form-control"
                                        placeholder="Masukan Year Start" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Year End</label>
                                    <input type="text" name="year_end" class="form-control"
                                        placeholder="Masukan Year End" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Position</label>
                                    <input type="text" name="position" class="form-control"
                                        placeholder="Masukan Position" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Department</label>
                                    <input type="text" name="department" class="form-control"
                                        placeholder="Masukan Department" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Division</label>
                                    <input type="text" name="division" class="form-control"
                                        placeholder="Masukan Division" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Company</label>
                                    <input type="text" name="company" class="form-control" placeholder="Masukan Company"
                                        required>
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
</script>
<?= $this->endSection() ?>