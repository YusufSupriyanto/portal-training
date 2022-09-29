<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-2">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="History">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah Training</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($user as $users) : ?>
                <tr>
                    <?php $page = basename($_SERVER['PHP_SELF']);
                        if ($page == 'history') :  ?>
                    <td>
                        <form id="myform<?= $i ?>" action="<?= base_url() ?>/detail_history" method="post">
                            <input type="hidden" name="history" value="<?= $users['id'] ?>" />
                        </form>
                        <a href="#"
                            onclick="document.getElementById('myform<?= $i ?>').submit();"><?= $users['nama'] ?></a>
                    </td>
                    <?php else : ?>
                    <td>
                        <form id="myform<?= $i ?>" action="<?= base_url() ?>/detail_historyunplan_admin" method="post">
                            <input type="hidden" name="history" value="<?= $users['id'] ?>" />
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
    <!-- /.card-body -->
</div>


<?= $this->endSection() ?>