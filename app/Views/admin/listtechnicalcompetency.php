<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Departemen Technical Competency</h3>
        </div>
        <div class="card-header">
            <form action="<?= base_url() ?>/input_technical" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Technical" name="Technical">
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
                    <?php foreach ($technical as $departemen) : ?>
                    <tr>
                        <td><a
                                href="<?= base_url() ?>/technical_departemen/<?= $departemen['departemen'] ?>"><?= $departemen['departemen'] ?></a>
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