<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="member">
            <thead>
                <tr>
                    <th>NPK</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Bagian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->npk ?></td>
                    <td><?php if (session()->get('bagian') == 'BOD' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'KADEPT') : ?>
                        <a href="<?= base_url() ?>\form_tna\<?= $users->id_user ?>"><?= $users->nama ?></a>
                        <?php else : ?>
                        <?= $users->nama ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->bagian ?></td>
                    <td><?= $users->status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<div class="card overflow-auto">
    <div class="card-header">
        <h3 class="card-title">Data Form TNA</h3>
    </div>
    <!-- /.card-header -->
    <form method="post" action="<?= base_url() ?>\tna\send">
        <div class="card-body p-0 overflow-auto">
            <table class="table table-striped overflow-auto">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Training</th>
                        <th>Jenis Training</th>
                        <th>Kategori Training</th>
                        <th>Metode Training</th>
                        <th>Rencana Training</th>
                        <th>Tujuan Training</th>
                        <th>Notes</th>
                        <th>Estimasi Budget</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tna as $Forms) : ?>
                    <tr>
                        <td><?= $Forms->nama ?></td>
                        <td><?= $Forms->training ?></td>
                        <td><?= $Forms->jenis_training ?></td>
                        <td><?= $Forms->kategori_training ?></td>
                        <td><?= $Forms->metode_training ?></td>
                        <td><?= $Forms->rencana_training ?></td>
                        <td><?= $Forms->tujuan_training ?></td>
                        <td><?= $Forms->notes ?></td>
                        <td><?= $Forms->biaya ?></td>
                    </tr>
                    <input type="hidden" value="<?= $Forms->id_training ?>" name="training[]">
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix d-flex justify-content-end pr-4">
            <button style="width:100px;" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-send"></i>Kirim</button>
        </div>
    </form>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>