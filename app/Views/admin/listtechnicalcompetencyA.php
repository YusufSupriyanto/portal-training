<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card m-1">
        <div class="card-header">
            <h3 class="card-title">Technical Competencies</h3>
        </div>
        <div class="card-header">
            <form action="<?= base_url() ?>/input_technical_file" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="A" name="golongan">
                    <label>Department</label>
                    <select class="form-control" name="department" required>
                        <option value="">Choose Department...</option>
                        <?php foreach ($department as $departemen) : ?>
                        <option value="<?= $departemen['departemen']  ?>"><?= $departemen['departemen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Technical" name="technical" required>
                        <label class="custom-file-label" for="Technical">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text">Upload</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Departemen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($technicalA as $departemen) : ?>
                    <tr>
                        <td><a
                                href="<?= base_url() ?>/technical_departemen/<?= $departemen['departemen'] ?>/A"><?= $departemen['departemen'] ?></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<?= $this->endSection() ?>