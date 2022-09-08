<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Training Monthly</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Planing Training</th>
                    <th>Jumlah Training</th>
                    <th>Admin Approval</th>
                    <th>Bod Approval</th>
                    <th>Reject</th>
                </tr>
            </thead>
            <?php $i = 0;
            foreach ($date as $dates) : ?>
            <tr>
                <td><a href=""><?= $dates->rencana_training ?></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php $i++;
            endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>