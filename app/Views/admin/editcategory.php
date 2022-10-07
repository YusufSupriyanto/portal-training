<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="m-1">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $tittle ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url() ?>/edit/<?= $category['id_categories'] ?>" method="post"
            enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>List Training/Non Training</label>
                    <input type="text" class="form-control" placeholder="Training / Non Training" name="list"
                        value="<?= $category['list'] ?>">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" placeholder="Category Training" name="category"
                        value="<?= $category['category'] ?>">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Masukan Deskripsi ..."
                        name="deskripsi"><?= $category['deskripsi'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Input gambar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" value="<?= $category['path'] ?>" name="file">
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
</div>
<?= $this->endSection() ?>