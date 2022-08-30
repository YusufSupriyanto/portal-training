<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-3">
    <div class="card-header">
        <!-- <h3 class="card-title">User</h3> -->
        <div class="card-tools">
            <div class="card-tools">
                <div class="card flex-row-reverse">
                    <div class="">
                        <form action="<?= base_url() ?>/addUser" method="post" enctype="multipart/form-data">
                            <div class="input-group">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append"></div>
                                <button type="submit" class="input-group-text" id="">Upload</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="user-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>DIC</th>
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Seksi</th>
                    <th>Bagian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->nama ?></td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->dic ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->seksi ?></td>
                    <td><?= $users->bagian ?></td>
                    <td><?= $users->status ?></td>
                    <td>
                        <div class="row">
                            <form action="<?= base_url() ?>\delete\user\<?= $users->id_user ?>" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm btn-delete"><i
                                        class="fa fa-fw fa-trash"></i></button>
                            </form>
                            <a href="<?= base_url() ?>\update\user\<?= $users->id_user ?>" type="button"
                                class="btn btn-warning btn-sm mt-2"><i class="fa fa-fw fa-edit"></i></a>
                        </div>
                    </td>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>