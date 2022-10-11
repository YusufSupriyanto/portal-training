<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
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
            $i = 0;
            foreach ($training as $dates) : ?>
            <tr>
                <?php $page = basename($_SERVER['PHP_SELF']);
                    if ($page == 'training_monthly') : ?>
                <td>
                    <a
                        href="<?= base_url() ?>/kadiv_accept/<?= $dates['Planing Training'] ?>"><?php $newDate = date('F d, Y', strtotime($dates['Planing Training']));
                                                                                                        echo $newDate   ?></a>
                </td>
                <?php else : ?>
                <td>
                    <a
                        href="<?= base_url() ?>/kadiv_accept_unplanned/<?= $dates['Planing Training'] ?>"><?php $newDate = date('F d, Y', strtotime($dates['Planing Training']));
                                                                                                                    echo $newDate   ?></a>
                </td>
                <?php endif; ?>

                <td>
                    <?= $dates['Jumlah Training'] ?>
                </td>
                <td><?= $dates['Admin Approval'] ?></td>
                <td><?= $dates['BOD Approval'] ?></td>
                <td><?= $dates['Admin Approval'] - $dates['BOD Approval'] ?>
                </td>
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