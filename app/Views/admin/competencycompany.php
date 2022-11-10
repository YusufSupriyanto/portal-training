<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex">
    <div class="card m-1" style="width:60%;">
        <div class="card-header d-flex justify-content-center">
            <h3 class=" card-title">Company General Competency</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" id="CompetencyCompany">

                <thead>
                    <tr>
                        <th>Company Competency</th>
                        <th>Proficiency</th>
                        <th>Divisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($company as $Company) : ?>
                    <tr>
                        <td><?= $Company['company'] ?></td>
                        <td><?= $Company['proficiency'] ?></td>
                        <td><?= $Company['divisi'] ?></td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-warning btn-sm mr-2"
                                    onclick="editCompetencyCompany('<?= $Company['id_company'] ?>','<?= $Company['company'] ?>','<?= $Company['proficiency'] ?>','<?= $Company['divisi'] ?>')">
                                    <i class="fa-solid fa-pen-to-square" style="font-size:17px;"></i>
                                </button>
                                <form action="<?= base_url() ?>\delete\company\<?= $Company['id_company'] ?>"
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
            <form role="form" action="<?= base_url() ?>/save_company" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="company">Company General Competency</label>
                        <input type="hidden" class="form-control" id="id_company" name="id_company">
                        <input type="text" class="form-control" id="company" name="company"
                            placeholder="Company General Competency	" required>
                    </div>
                    <div class="form-group">
                        <label for="proficiency">Proficiency</label>
                        <input type="text" class="form-control" id="proficiency" name="proficiency"
                            placeholder="Proficiency" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Divisi</label>
                        <input type="text" value="<?= $division ?>" class="form-control" id="divisi" name="divisi"
                            placeholder="Divisi" readonly>
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

function editCompetencyCompany(id, company, proficiency, divisi) {

    $('#id_company').val(id)
    $('#company').val(company)
    $('#proficiency').val(proficiency)
    $('#divisi').val(divisi)


}
</script>
<?= $this->endSection() ?>