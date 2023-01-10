<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="d-flex flex-row">
        <div class="card m-3">
            <button class="btn btn-primary btn-xl" id="department-file" onclick="ModalDepartment()"><i
                    class="fa fa-plus"></i> Add New Department</button>
        </div>
        <div class="card m-3">
            <button class="btn btn-primary btn-xl" onclick="UpdateDepartment()">
                <i class="fa-solid fa-pen"></i>Update Name Department
            </button>
        </div>
    </div>
    <!-- Modal Update Name Department -->
    <div class="modal fade" id="update-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update New Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>/update_department" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="update">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal New Name Department -->
    <div class="modal fade" id="Modal-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update New Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>/new_department" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="department" name="department">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group m-2">
        <form action="<?= base_url() ?>/change_structure" method="POST">
            <label>Change Name DIC</label>
            <select class="form-control" name="dic[]" required>
                <option value="">CHOOSE DIC</option>
                <?php foreach ($dic as $dic) : ?>
                <option value="<?= $dic['dic'] ?>"><?= $dic['dic'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="mt-2">
                <input class="form-control" type="text" name="dic[]" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success btn-xl">Change</button>
            </div>
        </form>
    </div>
    <div class="form-group m-2">
        <form action="<?= base_url() ?>/change_structure" method="POST">
            <label>Change Name DIVISI</label>
            <select class="form-control" name="divisi[]" required>
                <option value="">CHOOSE DIVISI</option>
                <?php foreach ($divisi as $divisi) : ?>
                <option value="<?= $divisi['divisi'] ?>"><?= $divisi['divisi'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="mt-2">
                <input class="form-control" type="text" name="divisi[]" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success btn-xl">Change</button>
            </div>
        </form>
    </div>
    <div class="form-group m-2">
        <form action="<?= base_url() ?>/change_structure" method="POST">
            <label>Change Name Department</label>
            <select class="form-control" name="department[]" required>
                <option value="">CHOOSE DEPARTMENT</option>
                <?php foreach ($department as $Department) : ?>
                <option value="<?= $Department['departemen'] ?>"><?= $Department['departemen'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="mt-2">
                <input class="form-control" type="text" name="department[]" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success btn-xl">Change</button>
            </div>
        </form>
    </div>
    <div class="form-group m-2">
        <form action="<?= base_url() ?>/change_structure" method="POST">
            <label>Change Section Name</label>
            <select class="form-control" name="seksi[]" required>
                <option value="">CHOOSE SEKSI</option>
                <?php foreach ($seksi as $seksi) : ?>
                <option value="<?= $seksi['seksi'] ?>"><?= $seksi['seksi'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="mt-2">
                <input class="form-control" type="text" name="seksi[]" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success btn-xl">Change</button>
            </div>
        </form>
    </div>
</div>
<script>
function ModalDepartment() {
    jQuery.noConflict()
    $('#Modal-department').modal('show')
}

function UpdateDepartment() {
    jQuery.noConflict()
    $('#update-department').modal('show')
}
</script>
<?= $this->endSection() ?>