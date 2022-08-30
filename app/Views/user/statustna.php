<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <form action="post" action="<?= base_url() ?>\tna\send">
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
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button style="width:100px;" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix d-flex justify-content-end pr-4">
            <button style="width:100px;" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-send"></i>Kirim</button>
        </div>
    </form>
</div>
<!-- /.card-body -->
<?= $this->endSection() ?>