<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <?php foreach ($jenis as $categories) : ?>
    <div class="card card-primary card-outline" style="height:400px;">
        <div class=" card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;"
                    src="<?= $categories->path  ?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center m-3 text-bold"><?= $categories->category ?></h3>

            <p class="text-muted text-left m-3"><?= $categories->deskripsi ?></p>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url() ?>/detail_user/<?= $categories->category ?>" class="btn btn-primary"
                    style="width:80px;height:40px"><b>Detail</b></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>