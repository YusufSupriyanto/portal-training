<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">

        <h3 class="card-title">Member History Training</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Training Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($user as $users) : ?>
                <tr>
                    <?php $page = basename($_SERVER['PHP_SELF']);
                        if ($page == 'member_history') : ?>
                    <td>
                        <form id="myform<?= $i ?>" action="<?= base_url() ?>/detail_history_member" method="post">
                            <input type="hidden" name="history[]" value="<?= $users['id'] ?>" />
                        </form>
                        <a href="#"
                            onclick="document.getElementById('myform<?= $i ?>').submit();"><?= $users['nama'] ?></a>
                    </td>
                    <?php else : ?>
                    <td>
                        <form id="myform<?= $i ?>" action="<?= base_url() ?>/detail_history_unplanned" method="post">
                            <input type="hidden" name="history[]" value="<?= $users['id'] ?>" />
                        </form>
                        <a href="#"
                            onclick="document.getElementById('myform<?= $i ?>').submit();"><?= $users['nama'] ?></a>
                    </td>
                    <?php endif; ?>


                    <td><?= $users['jumlah_training'] ?></td>
                </tr>
                <?php
                    $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>