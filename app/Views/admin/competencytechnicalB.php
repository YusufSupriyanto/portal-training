<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>

<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<style>
.mini-input {
    width: 30px;
}
</style>

<div class="d-flex justify-content-center">
    <div class="d-flex">
        <div class="card m-1">
            <div class="card-header d-flex justify-content-center">
                <h3 class=" card-title">Technical Competency Departemen <?= $department ?></h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body ">
                <table class="table table-striped" id="CompetencyAstra">
                    <thead>
                        <tr>
                            <th>Technical Competency</th>
                            <?php foreach ($jabatan as $department1) : ?>
                            <th><?= $department1['nama_jabatan'] ?></th>
                            <?php endforeach; ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($department0 as $department1) : ?>
                        <tr>
                            <td><?= $department1['technicalB'] ?></td>
                            <?php foreach ($jabatan as $Jabatan) : ?>
                            <?php $values = $value->getDataValue($Jabatan['nama_jabatan'], $department1['technicalB'], $department) ?>
                            <td><input type="button" value="<?= $values['proficiency'] ?>"
                                    onclick="ModalCompetency('<?= $values['id_technicalB'] ?>','<?= $values['technicalB'] ?>','<?= $values['proficiency'] ?>','<?= $values['nama_jabatan'] ?>')">
                            </td>
                            <?php endforeach; ?>
                            <td>
                                <form
                                    action="<?= base_url() ?>\delete_technicalB\<?= $department1['technicalB'] ?>\<?= $department ?>"
                                    method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete"><i
                                            class="fa fa-fw fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card m-1" style="width:300px;">
        <form role="form" action="<?= base_url() ?>/save_single_technicalB" method="post">
            <div class="d-flex">
                <div class="card-body">
                    <div class="form-group">
                        <label>Technical Competency</label>
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" value="<?= $department ?>" id="department" name="department">
                        <input type="text" class="form-control" placeholder="Technical Competency" id="technicalB"
                            name="technicalB" required>
                    </div>
                    <div class="form-group">
                        <label>Proficiency</label>
                        <input type="text" class="form-control" placeholder="Proficiency" id="proficiency"
                            name="proficiency" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" class="form-control" placeholder="Nama Jabatan" id="nama_jabatan" disabled>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="ml-4">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="mr-4">
                    <button type="button" class="btn btn-warning" onclick="CleanCompetency()"><i
                            class="fa-solid fa-broom"></i>Clean</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function ModalCompetency(id, technical, proficiency, nama_jabatan) {
    $('#id').val(id)
    $('#technicalB').val(technical)
    $('#proficiency').val(proficiency)
    $('#nama_jabatan').val(nama_jabatan)
}

function CleanCompetency() {
    $('#id').val("")
    $('#technicalB').val("")
    $('#proficiency').val("")
    $('#nama_jabatan').val("")
}
</script>
<?= $this->endSection() ?>