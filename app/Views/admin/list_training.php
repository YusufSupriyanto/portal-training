<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="import" data-import="<?= session()->get('import'); ?>"></div>
<div class="card-tools m-1">
    <div class="card flex-row justify-content-between">
        <div class="">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i>Add Category
            </button>
        </div>
        <div class="">
            <form action="<?= base_url() ?>/addCategory" method="post" enctype="multipart/form-data">
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
    </div>
</div>
<div class="card m-1">
    <?php foreach ($jenis as $categories) : ?>
    <div class="card card-primary card-outline" style="height:400px;">
        <div class=" card-body box-profile">
            <div class="d-flex flex-row">
                <div>
                    <a href="<?= base_url() ?>/update/<?= $categories->id_categories  ?>" type=" button"
                        class="btn btn-sm btn-warning ">Update</a>
                </div>
                <div class="pl-2">
                    <form action="<?= base_url() ?>/delete/<?= $categories->id_categories  ?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;"
                    src="<?= $categories->path  ?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center m-3 text-bold"><?= $categories->category ?></h3>

            <p class="text-muted text-left m-3"><?= $categories->deskripsi ?></p>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url() ?>/detail/<?= $categories->category ?>" class="btn btn-primary"
                    style="width:80px;height:40px"><b>Detail</b></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url() ?>/add_category" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Type Category</label>
                            <select class="form-control" name="list">
                                <option>Choose</option>
                                <option value="Training">Training</option>
                                <option value="Non Training">Non Training</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Category"
                                name="category">
                            <input type="hidden" class="form-control" id="exampleInputPassword1" value="0"
                                name="filter">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>