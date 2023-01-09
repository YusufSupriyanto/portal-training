<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">

        <h3 class="card-title">Evaluasi Reaksi Member TNA</h3>

    </div>
    <div class="card-body table-responsive p-0" style="height: 400px;">
        <table class="table table-head-fixed display" id="example2">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($user as $users) : ?>
                <tr>
                    <td>
                        <form id="myform<?= $i ?>" action="<?= base_url() ?>/detail_evaluasi_member" method="post">
                            <input type="hidden" name="evaluasi" value="<?= $users['id'] ?>" />
                        </form>
                        <a href="#"
                            onclick="document.getElementById('myform<?= $i ?>').submit();"><?= $users['nama'] ?></a>
                    </td>
                </tr>
                <?php
                    $i++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>