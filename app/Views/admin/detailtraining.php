<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="p-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Training</h3>
                <div class="card-tools">
                    <form action="<?= base_url() ?>/import" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append"></div>
                            <button type="submit" class="input-group-text" id="">Upload</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed display" id="example2">
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
                    <?php foreach ($jenis as $trainings) : ?>
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