<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card p-2 overflow-auto" id="evaluasi">
    <h4>
        <center>Evaluasi Program Pelatihan</center>
    </h4>
    <?php
    foreach ($data as $datas) : ?>
    <input type="hidden" value="<?= $datas['id_tna'] ?>" name="id_tna" id="id_tna">
    <div class="form-group">
        <label>Training Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-book"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $datas['training'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $datas['nama'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>NPK</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-id-card"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $datas['npk'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>DEPARTMENT</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-clipboard-user"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $datas['departemen'] ?>" disabled>
        </div>
    </div>
    <?php endforeach; ?>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Isi Program<span style="color:red;">*</span></th>
                    <th>4</th>
                    <th>3</th>
                    <th>2</th>
                    <th>1</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kesesuaian isi program terhadap sasaran training</td>
                    <td><input class="form-check-input" type="radio" value="4" name="program" required></td>
                    <td><input class="form-check-input" type="radio" value="3" name="program"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="program"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="program"></td>
                </tr>
                <tr>
                    <td>Tampilan hand-out bahan</td>
                    <td><input class="form-check-input" type="radio" value="4" name="tampilan" required></td>
                    <td><input class="form-check-input" type="radio" value="3" name="tampilan"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="tampilan"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="tampilan"></td>
                </tr>
                <tr>
                    <td>Isi program training</td>
                    <td><input class="form-check-input" type="radio" value="4" name="program_training" required>
                    </td>
                    <td><input class="form-check-input" type="radio" value="3" name="program_training"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="program_training"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="program_training"></td>
                </tr>
                <tr>
                    <td>Kesesuaian metode training dengan topik yang dibahas (pengguna contoh/latihan/diskusi/studi
                        kasus/outbound/games, untuk pemahaman)</td>
                    <td><input class="form-check-input" type="radio" value="4" name="metode" required></td>
                    <td><input class="form-check-input" type="radio" value="3" name="metode"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="metode"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="metode"></td>
                </tr>
                <tr>
                    <td>Penambahan keterampilan/pengetahuan dari program training yang diajarkan.</td>
                    <td><input class="form-check-input" type="radio" value="4" name="penambahan" required></td>
                    <td><input class="form-check-input" type="radio" value="3" name="penambahan"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="penambahan"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="penambahan"></td>
                </tr>
                <tr>
                    <td>Kelayakan penyajian materi yang diberikan (Audio/visual/audiovisual/peralatan lain yang
                        digunakan)
                    </td>
                    <td><input class="form-check-input" type="radio" value="4" name="kelayakan" required></td>
                    <td><input class="form-check-input" type="radio" value="3" name="kelayakan"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="kelayakan"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="kelayakan"></td>
                </tr>
                <tr>
                    <td>Kelayakan akomodasi/konsumsi/fasilitas training yang diberikan
                    </td>
                    <td><input class="form-check-input" type="radio" value="4" name="kelayakan_akomodasi" required>
                    </td>
                    <td><input class="form-check-input" type="radio" value="3" name="kelayakan_akomodasi"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="kelayakan_akomodasi"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="kelayakan_akomodasi"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <div class="form-group">
            <label>Hal-hal apa saja dari isi program yang telah memenuhi harapan anda ?</label>
            <textarea class="form-control mr-2" rows="3" placeholder="Enter ..." name="harapan"></textarea>
        </div>
        <div class="form-group">
            <label>Hal-hal yang perlu diperbaiki/ditingkatkan dari isi program ?</label>
            <textarea class="form-control mr-2" rows="3" placeholder="Enter ..." name="perbaikan_program"></textarea>
        </div>
    </div>
    <div class="card" id="instruktur">
        <div id="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>Pemahaman Instruktur</th>
                        <th>Instruktur 1<span style="color:red;">*</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><strong>Nama Instruktur</strong>
                        </td>
                        <td><input class="form-control input-sm" type="text" name="instruktur1" id="instruktur1"
                                required></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pengetahuan/pemahaman instruktur terhadap materi training
                        </td>
                        <td><input class="form-control input-sm" type="text" name="pengetahuan1" id="pengetahuan1"
                                required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kemampuan dalam menjelaskan materi training
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan1" id="kemampuan1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan1"
                                id="kemampuan_melibatkan1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi1"
                                id="kemampuan_menanggapi1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kemampuan mengendalikan penggunaan waktu
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan1"
                                id="kemampuan_mengendalikan1" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="m-2" style="width:100px;">
                <button type="button" class="btn btn-success btn-sm" id="plus" onclick="loop(1)"><i
                        class="fa-solid fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div>
        <div class="form-group ">
            <label class="">Hal-hal apa saja dari Instruktur yang telah memenuhi harapan anda?</label>
            <textarea class="form-control " rows="3" placeholder="Enter ..." name="harapan_instruktur"></textarea>
        </div>
        <div class="form-group ">
            <label class="">Hal-hal yang perlu diperbaiki/ditingkatkan dari Instruktur?</label>
            <textarea class="form-control " rows="3" placeholder="Enter ..." name="peningkatan_instruktur"></textarea>
        </div>
        <div class="form-group ">
            <label class="">Selama mengikuti training ini, insight (wawasan) apa yang anda dapatkan ? <span
                    style="color:red;">*</span></label>
            <textarea class="form-control " rows="3" placeholder="Enter ..." name="wawasan" id="wawasan"
                required></textarea>
        </div>
    </div>
    <div>

        <div class="card ">
            <label class="">Seberapa banyak anda mendapatkan pengetahuan/skill baru dari training ini ? <span
                    style="color:red;">*</span></label>
            <div class="form-group d-flex justify-content-between p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="25" required>
                    <label class=" form-check-label">25</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="50">
                    <label class="form-check-label">50</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="75">
                    <label class="form-check-label">75</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="100">
                    <label class=" form-check-label">100</label>
                </div>
            </div>
        </div>
        <div class="">
            <label class="">Apakah anda akan merekomendasikan training ini kepada rekan kerja yang lain
                ?<span style="color:red;">*</span></label>
            <div class="form-group d-flex justify-content-around p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi" value="1" required>
                    <label class=" form-check-label">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi" value="2">
                    <label class="form-check-label">Tidak</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class=""> Training apa yang Anda butuhkan di masa yang akan datang, dan alasannya?</label>
            <textarea class="form-control" rows="3" placeholder="Enter ..." name="kebutuhan"></textarea>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    const id_training = $('#id_tna').val()
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/data_evaluasi",
        async: true,
        dataType: "json",
        data: {
            id_training: id_training
        },
        success: function(data) {
            console.log(data)
            for (var i = 1; i <= 4; i++) {
                if (data[0].program == i) {
                    $('#evaluasi').find(':radio[name = program][value="' + i + '"]').prop('checked',
                        true)
                }
                if (data[0].tampilan == i) {
                    $('#evaluasi').find(':radio[name = tampilan][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
                if (data[0].program_training == i) {
                    $('#evaluasi').find(':radio[name = program_training][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
                if (data[0].metode == i) {
                    $('#evaluasi').find(':radio[name = metode][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
                if (data[0].kelayakan == i) {
                    $('#evaluasi').find(':radio[name = penambahan][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
                if (data[0].penambahan_keterampilan == i) {
                    $('#evaluasi').find(':radio[name = kelayakan][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
                if (data[0].kelayakan_akomodasi == i) {
                    $('#evaluasi').find(':radio[name = kelayakan_akomodasi][value="' + i + '"]')
                        .prop(
                            'checked',
                            true)
                }
                if (data[0].rekomendasi == i) {
                    $('#evaluasi').find(':radio[name = rekomendasi][value="' + i + '"]')
                        .prop(
                            'checked',
                            true)
                }

            }
            $('#harapan').val(data[0].harapan)
            $('#perbaikan_program').val(data[0].perbaikan_program)
            $('#instruktur1').val(data[0].instruktur_1)
            $('#pengetahuan1').val(data[0].pengetahuan1)
            $('#kemampuan1').val(data[0].kemampuan1)
            $('#kemampuan_melibatkan1').val(data[0].kemampuan_melibatkan1)
            $('#kemampuan_menanggapi1').val(data[0].kemampuan_menanggapi1)
            $('#kemampuan_mengendalikan1').val(data[0].kemampuan_mengendalikan1)
            $('#harapan_instruktur').val(data[0].harapan_instruktur)
            $('#peningkatan_instruktur').val(data[0].peningkatan_instruktur)
            $('#wawasan').val(data[0].wawasan)
            $('#kebutuhan').val(data[0].kebutuhan)

            for (var i = 1; i <= 100; i++) {
                if (data[0].skill == i) {
                    $('#evaluasi').find(':radio[name = skill][value="' + i + '"]')
                        .prop(
                            'checked',
                            true)
                }
            }


        }

    })

});

function loop(i) {
    const id_training = $('#id_tna').val()
    i++
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/data_evaluasi",
        async: true,
        dataType: "json",
        data: {
            id_training: id_training
        },
        success: function(data) {
            console.log(data)
            if (i <= 5) {
                $('#instruktur').append(`
          <div id="${i}">
    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>Pemahaman Instruktur</th>
                        <th>Instruktur ${i}<span style="color:red;">*</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><strong>Nama Instruktur</strong>
                        </td>
                        <td><input class="form-control input-sm" type="text" name="instruktur${i}" id="instruktur${i}" required></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pengetahuan/pemahaman instruktur terhadap materi training
                        </td>
                        <td><input class="form-control input-sm" type="text" name="pengetahuan${i}" id="pengetahuan${i}" required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kemampuan dalam menjelaskan materi training
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan${i}" id="kemampuan${i}" required></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan${i}" id="kemampuan_melibatkan${i}" required></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi${i}" id="kemampuan_menanggapi${i}" required></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kemampuan mengendalikan penggunaan waktu
                        </td>
                        <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan${i}" id="kemampuan_mengendalikan${i}" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="m-2" style="width:100px;">
                <button type="button" class="btn btn-success btn-sm" id="plus" onclick="loop(${i})"><i class="fa-solid fa-plus"></i></button>
           <button type="button" class="btn btn-danger btn-sm" id="remove${i}" onclick="remove(${i})"><i
                        class="fa fa-close"></i></button>
                </div>
            
                        </div>
            `)

                if (i == 2) {
                    const instruktur = data[0].instruktur_2
                    const pengetahuan = data[0].pengetahuan2
                    const kemampuan = data[0].kemampuan2
                    const kemampuan_melibatkan = data[0].kemampuan_melibatkan2
                    const kemampuan_menanggapi = data[0].kemampuan_menanggapi2
                    const kemampuan_mengendalikan = data[0].kemampuan_mengendalikan2
                    $('#instruktur' + i).val(instruktur)
                    $('#pengetahuan' + i).val(pengetahuan)
                    $('#kemampuan' + i).val(kemampuan)
                    $('#kemampuan_melibatkan' + i).val(kemampuan_melibatkan)
                    $('#kemampuan_menanggapi' + i).val(kemampuan_menanggapi)
                    $('#kemampuan_mengendalikan' + i).val(kemampuan_mengendalikan)
                } else if (i == 3) {
                    const instruktur = data[0].instruktur_3
                    const pengetahuan = data[0].pengetahuan3
                    const kemampuan = data[0].kemampuan3
                    const kemampuan_melibatkan = data[0].kemampuan_melibatkan3
                    const kemampuan_menanggapi = data[0].kemampuan_menanggapi3
                    const kemampuan_mengendalikan = data[0].kemampuan_mengendalikan3
                    $('#instruktur' + i).val(instruktur)
                    $('#pengetahuan' + i).val(pengetahuan)
                    $('#kemampuan' + i).val(kemampuan)
                    $('#kemampuan_melibatkan' + i).val(kemampuan_melibatkan)
                    $('#kemampuan_menanggapi' + i).val(kemampuan_menanggapi)
                    $('#kemampuan_mengendalikan' + i).val(kemampuan_mengendalikan)
                } else if (i == 4) {
                    const instruktur = data[0].instruktur_4
                    const pengetahuan = data[0].pengetahuan4
                    const kemampuan = data[0].kemampuan4
                    const kemampuan_melibatkan = data[0].kemampuan_melibatkan4
                    const kemampuan_menanggapi = data[0].kemampuan_menanggapi4
                    const kemampuan_mengendalikan = data[0].kemampuan_mengendalikan4
                    $('#instruktur' + i).val(instruktur)
                    $('#pengetahuan' + i).val(pengetahuan)
                    $('#kemampuan' + i).val(kemampuan)
                    $('#kemampuan_melibatkan' + i).val(kemampuan_melibatkan)
                    $('#kemampuan_menanggapi' + i).val(kemampuan_menanggapi)
                    $('#kemampuan_mengendalikan' + i).val(kemampuan_mengendalikan)
                } else {
                    const instruktur = data[0].instruktur_5
                    const pengetahuan = data[0].pengetahuan5
                    const kemampuan = data[0].kemampuan5
                    const kemampuan_melibatkan = data[0].kemampuan_melibatkan5
                    const kemampuan_menanggapi = data[0].kemampuan_menanggapi5
                    const kemampuan_mengendalikan = data[0].kemampuan_mengendalikan5
                    $('#instruktur' + i).val(instruktur)
                    $('#pengetahuan' + i).val(pengetahuan)
                    $('#kemampuan' + i).val(kemampuan)
                    $('#kemampuan_melibatkan' + i).val(kemampuan_melibatkan)
                    $('#kemampuan_menanggapi' + i).val(kemampuan_menanggapi)
                    $('#kemampuan_mengendalikan' + i).val(kemampuan_mengendalikan)
                }


            }


        }
    })



}
s

function remove(i) {
    $('#remove' + i).closest('#' + i).remove();
}
</script>
<?= $this->endSection() ?>