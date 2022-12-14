<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="form-group m-2">
        <form action="<?= base_url() ?>/change_structure" method="POST">
            <label>Change Name DIC</label>
            <select class="form-control" name="dic[]" required>
                <option value="">Chosee DIC</option>
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
            <label>Change Name Divisi</label>
            <select class="form-control" name="divisi[]" required>
                <option value="">Chosee Divisi</option>
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
                <option value="">Chosee Department</option>
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
            <label>Change Name Seksi</label>
            <select class="form-control" name="seksi[]" required>
                <option value="">Chosee seksi</option>
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
<?= $this->endSection() ?>