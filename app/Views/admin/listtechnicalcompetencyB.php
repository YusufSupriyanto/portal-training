<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card m-1">
        <div class="card-header">
            <h3 class="card-title">Technical Competencies</h3>
        </div>
        <div class="card-header">
            <form action="<?= base_url() ?>/multiple_input_technicalB" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Department</label>
                    <select class="form-control" name="department" id="department" required>
                        <option value="">Choose Department...</option>
                        <?php foreach ($department as $departemen) : ?>
                        <option value="<?= $departemen['departemen']  ?>">
                            <?= $departemen['departemen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="jabatan" class="form-group"></div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Technical" name="technical" required>
                        <label class="custom-file-label" for="Technical">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text">Upload</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Departemen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($technicalB as $departemen) : ?>
                    <tr>
                        <td><a
                                href="<?= base_url() ?>/technical_departemen/<?= $departemen['department'] ?>"><?= $departemen['department'] ?></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<script>
function displayNum() {
    department = $("select#department").val();
    console.log(department)
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/jabatan_user",
        data: {
            department: department
        },
        success: function(data) {
            $('#jabatan').html(data)
        }

    })
}

$("select#department").change(displayNum);
</script>
<?= $this->endSection() ?>