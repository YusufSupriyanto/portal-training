<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto">
            <thead></thead>
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
                        <div class="d-flex flex-row">
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm "><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- /.card-body -->
<?= $this->endSection() ?>