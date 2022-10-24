<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card card-primary m-1 overflow-auto">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body overflow-auto">
        <form role="form" action="" method="POST">
            <div class="form-group">
                <label>NPK</label>
                <input type="hidden" class="form-control" placeholder="Input NPK" value="<?= $user['id_user'] ?>"
                    name="profile[]">
                <input type="text" class="form-control" placeholder="Input NPK" value="<?= $user['npk'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Input Nama" value="<?= $user['nama'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" placeholder="Input Status" value="<?= $user['status'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Divisi</label>
                <input type="text" class="form-control" placeholder="Input Divisi" value="<?= $user['divisi'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Departemen</label>
                <input type="text" class="form-control" placeholder="Input Departemen"
                    value="<?= $user['departemen'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>Seksi</label>
                <input type="text" class="form-control" placeholder="Input Seksi" value="<?= $user['seksi'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Bagian</label>
                <input type="text" class="form-control" placeholder="Input Bagian" value="<?= $user['bagian'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>Promosi Terahir</label>
                <input type="text" class="form-control" value="<?= $user['promosi_terahir'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>Golongan</label>
                <input type="text" class="form-control" value="<?= $user['golongan'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" value="<?= $user['tgl_masuk'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>Masa Kerja</label>
                <div class="d-flex">
                    <label class="m-2">Tahun :</label>
                    <input type="text" class="form-control" value="<?= $user['tahun'] ?>" name="profile[]"
                        style="width:100px;">
                    <label class="m-2">Bulan :</label>
                    <input type="text" class="form-control" value="<?= $user['bulan'] ?>" name="profile[]"
                        style="width:100px;">
                </div>
            </div>
            <h6>Education</h6>
            <table class="table table-bordered overflow-auto">
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Year</th>
                        <th>Institution</th>
                        <th>Major</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="education-table">
                    <?php foreach ($education as $edu) : ?>
                    <tr>
                        <td>
                            <input type="text" value="<?= $edu['grade'] ?>" name="old">
                            <input type="hidden" value="<?= $edu['id_education'] ?>" name="old">
                        </td>
                        <td><input type="text" value="<?= $edu['year'] ?>" name="old"></td>
                        <td><input type="text" value="<?= $edu['institution'] ?>" name="old"></td>
                        <td><input type="text" value="<?= $edu['major'] ?>" name="old"></td>
                        <td><button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteEducationData(<?= $edu['id_education'] ?>)"><i
                                    class="fa fa-trash"></i></button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="m-2"> <button type="button" class="btn btn-success btn-sm" onclick="addEducation(0)"><i
                        class="fa fa-plus"></i></button></div>
            <h6>Career</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Year Start</th>
                        <th>Year End</th>
                        <th>Position</th>
                        <th>Departemen</th>
                        <th>Division</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="career-table">
                    <?php foreach ($career as $careers) : ?>
                    <tr>
                        <td>
                            <input type="hidden" value="<?= $careers['id_career'] ?>" name="old_career">
                            <input type="text" value="<?= $careers['year_start'] ?>" name="old_career"
                                style="width:50px;">
                        </td>
                        <td><input type="text" value="<?= $careers['year_end'] ?>" name="old_career"
                                style="width:50px;"></td>
                        <td><input type="text" value="<?= $careers['position'] ?>" name="old_career"></td>
                        <td><input type="text" value="<?= $careers['departement'] ?>" name="old_career"></td>
                        <td><input type="text" value="<?= $careers['division'] ?>" name="old_career"></td>
                        <td><input type="text" value="<?= $careers['company'] ?>" name="old_career"></td>
                        <td><button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteCareerData(<?= $careers['id_career'] ?>)"><i
                                    class="fa fa-trash"></i></button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="m-2"> <button type="button" class="btn btn-success btn-sm" onclick="addCareers(0)"><i
                        class="fa fa-plus"></i></button></div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="button" onclick="saveAll()" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<script>
function addEducation(i) {
    i++
    $('#education-table').append(`
        <tr id="column${i}">
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
        <td><input class="educationadds" name="edu" type="text"></td>
         <td>
                            <button type="button" class="btn btn-danger btn-sm" id="delete(${i})" onclick="removeEducation(${i})"><i
                                    class="fa fa-close"></i></button>
                        </td>
        </tr>
        `)
}

function addCareers(i) {
    i++
    $('#career-table').append(`
        <tr id="column_career${i}">
        <td><input class="career" name="career" type="text"  style="width:50px;"></td>
        <td><input class="career" name="career" type="text"  style="width:50px;"></td>
        <td><input class="career" name="career" type="text"></td>
        <td><input class="career" name="career" type="text"></td>
        <td><input class="career" name="career" type="text"></td>
        <td><input class="career" name="career" type="text"></td>
         <td>
                            <button type="button" class="btn btn-danger btn-sm" id="deleteCareer(${i})" onclick="removeCareer(${i})"><i
                                    class="fa fa-close"></i></button>
                        </td>
        </tr>
        `)
}

function saveAll() {
    let data = $("input[name='profile[]']").map(function() {
        return $(this).val();
    }).get();
    console.log(data)

    let edu_old = $("input[name='old']").map(function() {
        return $(this).val();
    }).get();
    console.log(edu_old)

    let edu_new = $("input[name='edu']").map(function() {
        return $(this).val();
    }).get();
    console.log(edu_new.length)
    let career_old = $("input[name='old_career']").map(function() {
        return $(this).val();
    }).get();
    console.log(career_old)
    let career_new = $("input[name='career']").map(function() {
        return $(this).val();
    }).get();
    console.log(career_new)



    if (edu_old.length == 0 || edu_old == undefined) {
        old_education = []
    } else {
        old_education = []
        while (edu_old.length > 0) {

            old_education.push(edu_old.splice(0, 5))
        }
    }

    if (edu_new.length == 0 || edu_new == undefined) {
        new_education = []
    } else {
        new_education = []
        while (edu_new.length > 0) {
            new_education.push(edu_new.splice(0, 4))
        }
    }


    if (career_old.length == 0 || career_old == undefined) {
        old_career = []
    } else {
        old_career = []
        while (career_old.length > 0) {
            old_career.push(career_old.splice(0, 7))
        }
        console.log(old_career)
    }


    if (career_new.length == 0 || career_new == undefined) {
        new_career = []
    } else {
        new_career = []
        while (career_new.length > 0) {
            new_career.push(career_new.splice(0, 6))
        }
        console.log(new_career)
    }
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/edit_user",
        async: true,
        dataType: "json",
        data: {
            individual: data,
            education_old: old_education,
            education_new: new_education,
            career_old: old_career,
            career_new: new_career

        },
        success: function(data) {
            window.location.reload()
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

function removeEducation(i) {
    $('#column' + i).remove();
}

function removeCareer(i) {
    $('#column_career' + i).remove();
}


function deleteEducationData(id) {
    console.log(id)
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/delete_education",
        async: true,
        dataType: "json",
        data: {
            id: id
        },
        success: function(data) {
            window.location.reload()
        }
    })
}


function deleteCareerData(id) {
    console.log(id)
    $.ajax({
        type: 'POST',
        url: "<?= base_url(); ?>/delete_career",
        async: true,
        dataType: "json",
        data: {
            id: id
        },
        success: function(data) {
            window.location.reload()
        }
    })
}
</script>
<?= $this->endSection() ?>