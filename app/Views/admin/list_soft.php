<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex">
    <div class="card m-1" style="width:60%;">
        <div class="card-header d-flex justify-content-center">
            <h3 class=" card-title">Soft Competency</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="form-group m-2">
                <form action="<?= base_url() ?>/soft_file" method="post" enctype="multipart/form-data">
                    <label for="exampleInputFile">Input Soft Competency</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-striped" id="CompetencySoft">

                <thead>
                    <tr>
                        <th>Soft Competency </th>
                        <th>Proficiency</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soft as $Soft) : ?>
                    <tr>
                        <td><?= $Soft['soft'] ?></td>
                        <td><?= $Soft['proficiency'] ?></td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-warning btn-sm mr-2">
                                    <i class="fa-solid fa-pen-to-square" style="font-size:17px;"
                                        onclick="editCompetencySoft('<?= $Soft['id_soft'] ?>','<?= $Soft['soft'] ?>','<?= $Soft['proficiency'] ?>')"></i>
                                </button>
                                <form action="<?= base_url() ?>\delete\soft\<?= $Soft['id_soft'] ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete"><i
                                            class="fa fa-fw fa-trash"></i></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card m-1" style="width:40%;">
        <div class="card card-primary">
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>/edit_competency_soft" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="soft">Soft Competency</label>
                        <input type="hidden" class="form-control" id="id_soft" name="id_soft">
                        <input type="text" class="form-control" id="soft" name="soft" placeholder="Soft Competency"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="proficiency">Proficiency</label>
                        <input type="text" class="form-control" id="proficiency" name="proficiency"
                            placeholder="Proficiency" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $('#CompetencySoft').DataTable();
});

function editCompetencySoft(id, soft, proficiency) {

    $('#id_soft').val(id)
    $('#soft').val(soft)
    $('#proficiency').val(proficiency)


}
</script>
<?= $this->endSection() ?>