<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex">
    <div class="card m-1" style="width:60%;">
        <div class="card-header d-flex justify-content-center">
            <h3 class=" card-title">Astra Leadership Competency</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" id="CompetencyAstra">

                <thead>
                    <tr>
                        <th>Astra Leadership Competency </th>
                        <th>Proficiency</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($astra as $Astra) : ?>
                    <tr>
                        <td><?= $Astra['astra'] ?></td>
                        <td><?= $Astra['proficiency'] ?></td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-warning btn-sm mr-2">
                                    <i class="fa-solid fa-pen-to-square" style="font-size:17px;"
                                        onclick="editCompetencyAtra('<?= $Astra['id_astra'] ?>','<?= $Astra['astra'] ?>','<?= $Astra['proficiency'] ?>')"></i>
                                </button>
                                <form action="<?= base_url() ?>\delete\astra\<?= $Astra['id_astra'] ?>" method="post">
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
            <form role="form" action="<?= base_url() ?>/edit_competency_astra" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="astra">Astra Leadership Competency</label>
                        <input type="hidden" class="form-control" id="id_astra" name="id_astra">
                        <input type="text" class="form-control" id="astra" name="astra"
                            placeholder="Astra Leadership Competency" required>
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
    $('#CompetencyAstra').DataTable();
});

function editCompetencyAtra(id, astra, proficiency) {

    $('#id_astra').val(id)
    $('#astra').val(astra)
    $('#proficiency').val(proficiency)


}
</script>
<?= $this->endSection() ?>