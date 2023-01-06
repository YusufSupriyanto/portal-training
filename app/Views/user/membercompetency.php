<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Member Profile</h3>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="member">
            <thead></thead>
            <tr>
                <th>NPK</th>
                <th>Name</th>
                <th>Status</th>
                <th>Division</th>
                <th>Department</th>
                <th>Section</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->npk ?></td>
                    <td>
                        <form action="<?= base_url() ?>\detail_competency" id="datacompetency<?= $i ?>" method="post">
                            <input type="hidden" name="member" id="member<?= $i ?>" value="<?= $users->id_user ?>">
                        </form>
                        <a href="#"
                            onclick="document.getElementById('datacompetency<?= $i ?>').submit();"><?= $users->nama ?></a>
                    </td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->bagian ?></td>
                    <td><?= $users->status ?></td>
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