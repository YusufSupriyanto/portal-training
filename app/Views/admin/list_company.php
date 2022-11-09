<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card m-1">
        <div class="card-header">
            <h3 class="card-title">Company General Competency</h3>
        </div>
        <div class="card-header">
            <form action="<?= base_url() ?>/input_company_file" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="A" name="golongan">
                    <label>Divisi</label>
                    <select class="form-control" name="divisi" required>
                        <option value="">Choose Divisi...</option>
                        <?php foreach ($divisi as $division) : ?>
                        <option value="<?= $division['divisi']  ?>"><?= $division['divisi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="company" name="company" required>
                        <label class="custom-file-label" for="company">Choose file</label>
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
                        <th>Divisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($CompanyDivisi as $division) : ?>
                    <tr>
                        <td><a
                                href="<?= base_url() ?>/company_division/<?= $division['divisi'] ?>"><?= $division['divisi'] ?></a>
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