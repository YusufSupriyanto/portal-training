<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card card-primary m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="<?= base_url() ?>\edit\user\<?= $user['id_user'] ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>NPK</label>
                <input type="text" class="form-control" placeholder="Input NPK" value="<?= $user['npk'] ?>" name="npk">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Input Nama" value="<?= $user['nama'] ?>"
                    name="nama">
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" placeholder="Input Status" value="<?= $user['status'] ?>"
                    name="status">
            </div>
            <div class="form-group">
                <label>Divisi</label>
                <input type="text" class="form-control" placeholder="Input Divisi" value="<?= $user['divisi'] ?>"
                    name="divisi">
            </div>
            <div class="form-group">
                <label>Departemen</label>
                <input type="text" class="form-control" placeholder="Input Departemen"
                    value="<?= $user['departemen'] ?>" name="departemen">
            </div>
            <div class="form-group">
                <label>Seksi</label>
                <input type="text" class="form-control" placeholder="Input Seksi" value="<?= $user['seksi'] ?>"
                    name="seksi">
            </div>
            <div class="form-group">
                <label>Bagian</label>
                <input type="text" class="form-control" placeholder="Input Bagian" value="<?= $user['bagian'] ?>"
                    name="bagian">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>