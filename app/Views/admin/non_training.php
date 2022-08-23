<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="import" data-import="<?= session()->get('import'); ?>"></div>
<div class="card-tools p-3">
    <div class="card flex-row-reverse">
        <div class="m">
            <button type="button" class="btn btn-block btn-danger btn-sm h-100">Add Category</button>
        </div>
        <div class="mr-3">
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


<div class="card p-3">
    <?php foreach ($jenis as $categories) : ?>
    <div class="card card-primary card-outline">
        <div class=" card-body box-profile">
            <div class="d-flex flex-row">
                <div>
                    <a href="<?= base_url() ?>/update/<?= $categories->id_categories  ?>" type=" button"
                        class="btn btn-sm btn-warning ">Update</a>
                </div>
                <div class="pl-2">
                    <form action="<?= base_url() ?>/delete/<?= $categories->id_categories  ?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm btn-category">Delete</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="<?= $categories->path  ?>"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center m-3 text-bold"><?= $categories->category ?></h3>

            <p class="text-muted text-left m-3"><?= $categories->deskripsi ?></p>
            <a href="<?= base_url() ?>/detail/<?= $categories->category ?>"
                class="btn btn-primary btn-sm"><b>Detail</b></a>

        </div>

    </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>