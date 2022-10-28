<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex">
    <div class="card m-1" style="width:60%;">
        <div class="card-header d-flex justify-content-center">
            <h3 class=" card-title">Technical Competency</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" id="CompetencyAstra">

                <thead>
                    <tr>
                        <th>Technical Competency</th>
                        <th>Proficiency</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($technical as $Technical) : ?>
                    <tr>
                        <td><?= $Technical['technical'] ?></td>
                        <td><?= $Technical['proficiency'] ?></td>
                        <td><?= $Technical['departemen'] ?></td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-warning btn-sm mr-2"
                                    onclick="editCompetencyTechnical('<?= $Technical['id_technical'] ?>','<?= $Technical['technical'] ?>','<?= $Technical['proficiency'] ?>','<?= $Technical['departemen'] ?>')">
                                    <i class="fa-solid fa-pen-to-square" style="font-size:17px;"></i>
                                </button>
                                <form action="<?= base_url() ?>\delete\technical\<?= $Technical['id_technical'] ?>"
                                    method="post">
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
            <form role="form" action="<?= base_url() ?>/save_technical" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="technical">Technical Competency</label>
                        <input type="hidden" class="form-control" id="id_technical" name="id_technical">
                        <input type="text" class="form-control" id="technical" name="technical"
                            placeholder="Technical Competency" required>
                    </div>
                    <div class="form-group">
                        <label for="proficiency">Proficiency</label>
                        <input type="text" class="form-control" id="proficiency" name="proficiency"
                            placeholder="Proficiency" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department"
                            placeholder="Department" required>
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
    $('#CompetencyAstra').DataTable();
});

function editCompetencyTechnical(id, technical, proficiency, department) {

    $('#id_technical').val(id)
    $('#technical').val(technical)
    $('#proficiency').val(proficiency)
    $('#department').val(department)


}
</script>
<?= $this->endSection() ?>