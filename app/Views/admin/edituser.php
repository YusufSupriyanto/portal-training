<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card card-primary m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">
        <form role="form" action="<?= base_url() ?>\edit_user\<?= $user['id_user'] ?>" method="POST">
            <div class="form-group">
                <label>NPK</label>
                <input type="text" class="form-control" placeholder="Input NPK" value="<?= $user['npk'] ?>" name="npk">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Input Nama" value="<?= $user['nama'] ?>"
                    name="nama">
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" placeholder="Input Status" value="<?= $user['status'] ?>"
                    name="status">
            </div>
            <div class="form-group">
                <label>Divisi</label>
                <input type="text" class="form-control" placeholder="Input Divisi" value="<?= $user['divisi'] ?>"
                    name="divisi">
            </div>
            <div class="form-group">
                <label>Departemen</label>
                <input type="text" class="form-control" placeholder="Input Departemen"
                    value="<?= $user['departemen'] ?>" name="departemen">
            </div>
            <div class="form-group">
                <label>Seksi</label>
                <input type="text" class="form-control" placeholder="Input Seksi" value="<?= $user['seksi'] ?>"
                    name="seksi">
            </div>
            <div class="form-group">
                <label>Bagian</label>
                <input type="text" class="form-control" placeholder="Input Bagian" value="<?= $user['bagian'] ?>"
                    name="bagian">
            </div>
            <div>Education</div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Year</th>
                        <th>Institution</th>
                        <th>Major</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="education-table">
                    <?php foreach ($education as $edu) : ?>
                    <tr>
                        <td>
                            <input type="text" value="<?= $edu['grade'] ?>" name="grade">
                            <input type="hidden" value="<?= $edu['id_education'] ?>" name="id_education">
                        </td>
                        <td><input type="text" value="<?= $edu['year'] ?>" name="year"></td>
                        <td><input type="text" value="<?= $edu['institution'] ?>" name="institution"></td>
                        <td><input type="text" value="<?= $edu['major'] ?>" name="major"></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" onclick="addEducation()"><i
                                    class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <div>Education</div>
            <div>Career</div>
            <div class="form-group">
                <label for="exampleInputPassword1">Year Start</label>
                <input type="text" name="year_start" class="form-control" placeholder="Masukan Year Start" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Year End</label>
                <input type="text" name="year_end" class="form-control" placeholder="Masukan Year End" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Position</label>
                <input type="text" name="position" class="form-control" placeholder="Masukan Position" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Department</label>
                <input type="text" name="department" class="form-control" placeholder="Masukan Department" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Division</label>
                <input type="text" name="division" class="form-control" placeholder="Masukan Division" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Company</label>
                <input type="text" name="company" class="form-control" placeholder="Masukan Company" required>
            </div> -->
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="button" onclick="saveAll()" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<script>
function addEducation() {

    $('#education-table').append(`
        <tr>
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
         <td>
                            <button type="button" class="btn btn-success btn-sm" onclick="addEducation()"><i
                                    class="fa fa-plus"></i></button>
                        </td>
        </tr>
        `)
}

function saveAll() {
    let data = $(':input').serializeArray()
    console.log(data)
    let arr1 = [
        data[0]['value'],
        data[1]['value']

    ];
    var result = data.filter(obj => {
        return obj.name == 'edu'
    })
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/edit_user",
        async: true,
        dataType: "json",
        data: {
            id_user: result
        },
        success: function(data) {
            console.log(data)
        }
    })
    // console.log(result)
}

function changeEducation(id) {
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/get_education",
        async: true,
        dataType: "json",
        data: {
            id_education: id
        },
        success: function(data) {
            console.log(data)
            jQuery.noConflict()
            $('#educationEdit #grade').val(data.grade)
            $('#educationEdit #year').val(data.year)
            $('#educationEdit #institution').val(data.institution)
            $('#educationEdit #major').val(data.major)
            $('#educationEdit').modal('show')

        }
    })
}
</script>
<?= $this->endSection() ?>