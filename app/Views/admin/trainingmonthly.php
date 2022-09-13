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
                    <th>BOD Approval</th>
                    <th style="color:red;">Reject</th>
                </tr>
            </thead>
            <?php

            use Faker\Provider\Base;

            $i = 0;
            foreach ($training as $dates) : ?>
            <tr>
                <td><a
                        href="<?= base_url() ?>/kadiv_accept/<?= $dates['Planing Training'] ?>"><?php $newDate = date('F d, Y', strtotime($dates['Planing Training']));
                                                                                                    echo $newDate   ?></a>
                </td>
                <td>
                    <?= $dates['Jumlah Training'] ?>
                </td>
                <td><?= $dates['Admin Approval'] ?></td>
                <td><?= $dates['BOD Approval'] ?></td>
                <td> <?= $dates['Jumlah Training'] - $dates['BOD Approval']   ?></td>
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