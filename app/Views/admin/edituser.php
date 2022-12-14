<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card card-primary m-1 overflow-auto">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
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
                <label>NAME</label>
                <input type="text" class="form-control" placeholder="Input Nama" value="<?= $user['nama'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>STATUS</label>
                <input type="text" class="form-control" placeholder="Input Status" value="<?= $user['status'] ?>"
                    name="profile[]">
            </div>
            <div class="form-group">
                <label>DIC</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['dic'] ?>" selected><?= $user['dic'] ?></option>
                    <?php foreach ($dic as $Dic) : ?>
                    <option><?= $Dic['dic'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>DIVISI</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['divisi'] ?>" selected><?= $user['divisi'] ?></option>
                    <?php foreach ($divisi as $Divisi) : ?>
                    <option><?= $Divisi['divisi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>DEPARTMENT</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['departemen'] ?>" selected><?= $user['departemen'] ?></option>
                    <?php foreach ($departemen as $Departemen) : ?>
                    <option><?= $Departemen['departemen'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>SEKSI</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['seksi'] ?>" selected><?= $user['seksi'] ?></option>
                    <?php foreach ($seksi as $Seksi) : ?>
                    <option><?= $Seksi['seksi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>BAGIAN</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['bagian'] ?>" selected><?= $user['bagian'] ?></option>
                    <?php foreach ($bagian as $Bagian) : ?>
                    <option><?= $Bagian['bagian'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>TYPE GROUP</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['type_golongan'] ?>" selected><?= $user['type_golongan'] ?></option>
                    <?php foreach ($type_golongan as $golongan) : ?>
                    <option value="<?= $golongan['type_golongan'] ?>"><?= $golongan['type_golongan'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>TYPE USER</label>
                <select class="form-control" name="profile[]">
                    <option value="<?= $user['type_user'] ?>" selected><?= $user['type_user'] ?></option>
                    <?php foreach ($type_user as $TypeUser) : ?>
                    <option value="<?= $TypeUser['type_user'] ?>"><?= $TypeUser['type_user'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>LAST PROMOTION</label>
                <input type="date" class="form-control" value="<?= $user['promosi_terakhir'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>GROUP</label>
                <input type="text" class="form-control" value="<?= $user['golongan'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>DATE OF ENTRY</label>
                <input type="date" class="form-control" value="<?= $user['tgl_masuk'] ?>" name="profile[]">
            </div>
            <div class="form-group">
                <label>YEARS OF SERVICE</label>
                <div class="d-flex">
                    <input type="text" class="form-control" value="<?= $user['tahun'] ?>" name="profile[]"
                        style="width:100px;" readonly>
                    <label class="m-2">YEAR </label>

                    <input type="text" class="form-control" value="<?= $user['bulan'] ?>" name="profile[]"
                        style="width:100px;" readonly>
                    <label class="m-2">MONTH </label>
                </div>
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="text" class="form-control" placeholder="Input Email" value="<?= $user['email'] ?>"
                    name="profile[]">
            </div>
            <h6>EDUCATION</h6>
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
            <h6>CAREER</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Year Start</th>
                        <th>Year End</th>
                        <th>Position</th>
                        <th>Department</th>
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
        <td><input class="educationadds" name="edu" type="text" required></td>
        <td><input class="educationadds" name="edu" type="text" required></td>
        <td><input class="educationadds" name="edu" type="text" required></td>
        <td><input class="educationadds" name="edu" type="text" required></td>
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
        <td><input class="career" name="career" type="text"  style="width:50px;" required></td>
        <td><input class="career" name="career" type="text"  style="width:50px;" required></td>
        <td><input class="career" name="career" type="text" required></td>
        <td><input class="career" name="career" type="text" required></td>
        <td><input class="career" name="career" type="text" required></td>
        <td><input class="career" name="career" type="text" required></td>
         <td>
                            <button type="button" class="btn btn-danger btn-sm" id="deleteCareer(${i})" onclick="removeCareer(${i})"><i
                                    class="fa fa-close"></i></button>
                        </td>
        </tr>
        `)
}

//function for save all
function saveAll() {

    let data = $("[name='profile[]']").map(function() {
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
            //window.location.reload()
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