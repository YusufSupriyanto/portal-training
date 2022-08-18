<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="p-3">
    <div class="card">
        <div class="flex-row">
            <form action="<?= base_url() ?>/import" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile04" name="file">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Button</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="pt-2">
            <!-- Default box -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Training</h3>


                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: none;">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Culture</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="display: none;">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 10%">
                                            Judul Training
                                        </th>
                                        <th style="width: 10%">
                                            Deskripsi
                                        </th>
                                        <th style="width: 10%">
                                            Vendor
                                        </th>
                                        <th style="width: 10%">
                                            Estimasi Biaya
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($training as $trainings) : ?>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <h6><?= $trainings['judul_training'] ?></h6>
                                        </td>
                                        <td>
                                            <h6><?= $trainings['deskripsi'] ?></h6>
                                        </td>
                                        <td>
                                            <h6><?= $trainings['vendor'] ?></h6>
                                        </td>
                                        <td>
                                            <h6><?= $trainings['biaya'] ?></h6>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Default box -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Pengembangan Non Training</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: none;">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    Project Name
                                </th>
                                <th style="width: 30%">
                                    Team Members
                                </th>
                                <th>
                                    Project Progress
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        AdminLTE v3
                                    </a>
                                    <br>
                                    <small>
                                        Created 01.01.2019
                                    </small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar04.png">
                                        </li>
                                    </ul>
                                </td>
                                <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57"
                                            aria-volumemin="0" aria-volumemax="100" style="width: 57%">
                                        </div>
                                    </div>
                                    <small>
                                        57% Complete
                                    </small>
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-success">Success</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>