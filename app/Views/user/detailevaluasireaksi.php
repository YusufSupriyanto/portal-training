<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3" id="evaluasi">
    <div class="d-flex justify-content-center">
        <h4>Evaluasi Program Pelatihan</h4>
    </div>
    <div class="card m-2 p-2">
        <?php foreach ($data as $datas) : ?>
        <input type="hidden" value="<?= $datas['id_tna'] ?>" id="id_tna">
        <label>
            Nama Training<span> :<?= " " . $datas['training'] ?></span>
        </label>
        <label>
            Nama<span> :<?= " " . $datas['nama'] ?></span>
        </label>
        <label>
            Npk<span> :<?= " " . $datas['npk'] ?></span>
        </label>
        <label>
            Dept<span> :<?= " " . $datas['bagian'] ?></span>
        </label>
        <?php endforeach; ?>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th> Isi Program</th>
                <th>4</th>
                <th>3</th>
                <th>2</th>
                <th>1</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Kesesuaian isi program terhadap sasaran training</td>
                <td><input class="form-check-input" type="radio" value="4" name="program" id="program4"></td>
                <td><input class="form-check-input" type="radio" value="3" name="program" id="program3"></td>
                <td><input class="form-check-input" type="radio" value="2" name="program" id="program2"></td>
                <td><input class="form-check-input" type="radio" value="1" name="program" id="program1"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tampilan hand-out bahan</td>
                <td><input class="form-check-input" type="radio" value="4" name="tampilan"></td>
                <td><input class="form-check-input" type="radio" value="3" name="tampilan"></td>
                <td><input class="form-check-input" type="radio" value="2" name="tampilan"></td>
                <td><input class="form-check-input" type="radio" value="1" name="tampilan"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Isi program training</td>
                <td><input class="form-check-input" type="radio" value="4" name="program_training"></td>
                <td><input class="form-check-input" type="radio" value="3" name="program_training"></td>
                <td><input class="form-check-input" type="radio" value="2" name="program_training"></td>
                <td><input class="form-check-input" type="radio" value="1" name="program_training"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Kesesuaian metode training dengan topik yang dibahas (pengguna contoh/latihan/diskusi/studi
                    kasus/outbound/games, untuk pemahaman)</td>
                <td><input class="form-check-input" type="radio" value="4" name="metode"></td>
                <td><input class="form-check-input" type="radio" value="3" name="metode"></td>
                <td><input class="form-check-input" type="radio" value="2" name="metode"></td>
                <td><input class="form-check-input" type="radio" value="1" name="metode"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Penambahan keterampilan/pengetahuan dari program training yang diajarkan.</td>
                <td><input class="form-check-input" type="radio" value="4" name="penambahan"></td>
                <td><input class="form-check-input" type="radio" value="3" name="penambahan"></td>
                <td><input class="form-check-input" type="radio" value="2" name="penambahan"></td>
                <td><input class="form-check-input" type="radio" value="1" name="penambahan"></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Kelayakan penyajian materi yang diberikan (Audio/visual/audiovisual/peralatan lain yang
                    digunakan)
                </td>
                <td><input class="form-check-input" type="radio" value="4" name="kelayakan"></td>
                <td><input class="form-check-input" type="radio" value="3" name="kelayakan"></td>
                <td><input class="form-check-input" type="radio" value="2" name="kelayakan"></td>
                <td><input class="form-check-input" type="radio" value="1" name="kelayakan"></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Kelayakan akomodasi/konsumsi/fasilitas training yang diberikan
                </td>
                <td><input class="form-check-input" type="radio" value="4" name="kelayakan_akomodasi"></td>
                <td><input class="form-check-input" type="radio" value="3" name="kelayakan_akomodasi"></td>
                <td><input class="form-check-input" type="radio" value="2" name="kelayakan_akomodasi"></td>
                <td><input class="form-check-input" type="radio" value="1" name="kelayakan_akomodasi"></td>
            </tr>
        </tbody>
    </table>
    <div class="form-group m-3">
        <label class="ml-2">Hal-hal apa saja dari isi program yang telah memenuhi harapan anda ?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="harapan" id="harapan"></textarea>
    </div>
    <div class="form-group m-3">
        <label class="ml-2">Hal-hal yang perlu diperbaiki/ditingkatkan dari isi program ?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="perbaikan_program"
            id="perbaikan_program"></textarea>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Pemahaman Instruktur</th>
                <th>Instruktur 1</th>
                <th>Instruktur 2</th>
                <th>Instruktur 3</th>
                <th>Instruktur 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><strong>Nama Instruktur</strong>
                </td>
                <td><input class="form-control input-sm" type="text" name="instruktur1" id="instruktur1"></td>
                <td><input class="form-control input-sm" type="text" name="instruktur2" id="instruktur2"></td>
                <td><input class="form-control input-sm" type="text" name="instruktur3" id="instruktur3"></td>
                <td><input class="form-control input-sm" type="text" name="instruktur4" id="instruktur4"></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Pengetahuan/pemahaman instruktur terhadap materi training
                </td>
                <td><input class="form-control input-sm" type="text" name="pengetahuan1" id="pengetahuan1"></td>
                <td><input class="form-control input-sm" type="text" name="pengetahuan2" id="pengetahuan2"></td>
                <td><input class="form-control input-sm" type="text" name="pengetahuan3" id="pengetahuan3"></td>
                <td><input class="form-control input-sm" type="text" name="pengetahuan4" id="pengetahuan4"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kemampuan dalam menjelaskan materi training
                </td>
                <td><input class="form-control input-sm" type="text" name="kemampuan1" id="kemampuan1"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan2" id="kemampuan2"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan3" id="kemampuan3"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan4" id="kemampuan4"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                </td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan1"
                        id="kemampuan_melibatkan1"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan2"
                        id="kemampuan_melibatkan2"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan3"
                        id="kemampuan_melibatkan3"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan4"
                        id="kemampuan_melibatkan4"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                </td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi1"
                        id="kemampuan_menanggapi1"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi2"
                        id="kemampuan_menanggapi2"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi3"
                        id="kemampuan_menanggapi3"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi4"
                        id="kemampuan_menanggapi4"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Kemampuan mengendalikan penggunaan waktu
                </td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan1"
                        id="kemampuan_mengendalikan1"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan2"
                        id="kemampuan_mengendalikan2"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan3"
                        id="kemampuan_mengendalikan3"></td>
                <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan4"
                        id="kemampuan_mengendalikan4"></td>
            </tr>
        </tbody>
    </table>
    <div class="form-group m-3">
        <label class="ml-2">Hal-hal apa saja dari Instruktur yang telah memenuhi harapan anda?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="harapan_instruktur"
            id="harapan_instruktur"></textarea>
    </div>
    <div class="form-group m-3">
        <label class="ml-2">Hal-hal yang perlu diperbaiki/ditingkatkan dari Instruktur?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="peningkatan_instruktur"
            id="peningkatan_instruktur"></textarea>
    </div>
    <div class="form-group m-3">
        <label class="ml-2">Selama mengikuti training ini, insight (wawasan) apa yang anda dapatkan ?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="wawasan" id="wawasan"></textarea>
    </div>
    <div class="d-flex flex-row">
        <div class="card m-3">
            <label class="ml-2">Seberapa banyak anda mendapatkan pengetahuan/skill baru dari training ini ?</label>
            <div class="form-group d-flex justify-content-between p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="25">
                    <label class=" form-check-label">25</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="50">
                    <label class="form-check-label">50</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="75">
                    <label class=" form-check-label">75</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill" value="100">
                    <label class=" form-check-label">100</label>
                </div>
            </div>
        </div>
        <div class="card m-3">
            <label class="ml-2">Apakah anda akan merekomendasikan training ini kepada rekan kerja yang lain
                ?</label>
            <div class="form-group d-flex justify-content-around p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi" value="1">
                    <label class=" form-check-label">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi" value="2">
                    <label class="form-check-label">Tidak</label>
                </div>
            </div>
        </div>

    </div>
    <div class="form-group m-3">
        <label class="ml-2"> Training apa yang Anda butuhkan di masa yang akan datang, dan alasannya?</label>
        <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="kebutuhan" id="kebutuhan"></textarea>
    </div>
</div>
<script>
$(document).ready(function() {
    const id_training = $('#id_tna').val()
    // console.log(id_training)
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
            $('#instruktur2').val(data[0].instruktur_2)
            $('#instruktur3').val(data[0].instruktur_3)
            $('#instruktur4').val(data[0].instruktur_4)
            $('#pengetahuan1').val(data[0].pengetahuan1)
            $('#pengetahuan2').val(data[0].pengetahuan2)
            $('#pengetahuan3').val(data[0].pengetahuan3)
            $('#pengetahuan4').val(data[0].pengetahuan4)
            $('#kemampuan1').val(data[0].kemampuan1)
            $('#kemampuan2').val(data[0].kemampuan2)
            $('#kemampuan3').val(data[0].kemampuan3)
            $('#kemampuan4').val(data[0].kemampuan4)
            $('#kemampuan_melibatkan1').val(data[0].kemampuan_melibatkan1)
            $('#kemampuan_melibatkan2').val(data[0].kemampuan_melibatkan2)
            $('#kemampuan_melibatkan3').val(data[0].kemampuan_melibatkan3)
            $('#kemampuan_melibatkan4').val(data[0].kemampuan_melibatkan4)
            $('#kemampuan_menanggapi1').val(data[0].kemampuan_menanggapi1)
            $('#kemampuan_menanggapi2').val(data[0].kemampuan_menanggapi2)
            $('#kemampuan_menanggapi3').val(data[0].kemampuan_menanggapi3)
            $('#kemampuan_menanggapi4').val(data[0].kemampuan_menanggapi4)
            $('#kemampuan_mengendalikan1').val(data[0].kemampuan_mengendalikan1)
            $('#kemampuan_mengendalikan2').val(data[0].kemampuan_mengendalikan2)
            $('#kemampuan_mengendalikan3').val(data[0].kemampuan_mengendalikan3)
            $('#kemampuan_mengendalikan4').val(data[0].kemampuan_mengendalikan4)
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
</script>

<?= $this->endSection() ?><div class="container">