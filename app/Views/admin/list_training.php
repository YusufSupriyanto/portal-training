<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="import" data-import="<?= session()->get('import'); ?>"></div>
<div class="p-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Training</h3>

                <div class="card-tools pl-4">
                    <form method="get" action="">
                        <div class="input-group">
                            <select name="filter" class="custom-select" id="inputGroupSelect04">
                                <option selected>Choose...</option>
                                <?php foreach ($jenis as $key => $value) : ?>
                                <option class=" category" value="<?= $value->jenis_training ?>">
                                    <?= $value->jenis_training ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-tools">
                    <form action="<?= base_url() ?>/import" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text" id="">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th>Judul Training</th>
                            <th>Jenis Training</th>
                            <th>Deskripsi</th>
                            <th>Vendor</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($training as $trainings) : ?>
                        <tr>
                            <td><?= $trainings->judul_training ?></td>
                            <td><?= $trainings->jenis_training ?></td>
                            <td><?= $trainings->deskripsi ?></td>
                            <td><?= $trainings->vendor ?></td>
                            <td><?= $trainings->biaya ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>