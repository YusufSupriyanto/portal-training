<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card p-2 overflow-auto">
    <form method="post" action="<?= base_url() ?>/send_evaluasi_reaksi">
        <h4>
            <center>Evaluasi Program Pelatihan</center>
        </h4>
        <?php foreach ($data as $datas) : ?>
        <input type="hidden" value="<?= $datas['id_tna'] ?>" name="id_tna">
        <div class="form-group">
            <label>Nama Training</label>
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
            <label>Nama</label>
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
            <label>DEPT</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-clipboard-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" value="<?= $datas['bagian'] ?>" disabled>
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
                        <td><input class="form-check-input" type="radio" value="4" name="program[]" required></td>
                        <td><input class="form-check-input" type="radio" value="3" name="program[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="program[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="program[]"></td>
                    </tr>
                    <tr>
                        <td>Tampilan hand-out bahan</td>
                        <td><input class="form-check-input" type="radio" value="4" name="tampilan[]" required></td>
                        <td><input class="form-check-input" type="radio" value="3" name="tampilan[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="tampilan[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="tampilan[]"></td>
                    </tr>
                    <tr>
                        <td>Isi program training</td>
                        <td><input class="form-check-input" type="radio" value="4" name="program_training[]" required>
                        </td>
                        <td><input class="form-check-input" type="radio" value="3" name="program_training[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="program_training[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="program_training[]"></td>
                    </tr>
                    <tr>
                        <td>Kesesuaian metode training dengan topik yang dibahas (pengguna contoh/latihan/diskusi/studi
                            kasus/outbound/games, untuk pemahaman)</td>
                        <td><input class="form-check-input" type="radio" value="4" name="metode[]" required></td>
                        <td><input class="form-check-input" type="radio" value="3" name="metode[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="metode[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="metode[]"></td>
                    </tr>
                    <tr>
                        <td>Penambahan keterampilan/pengetahuan dari program training yang diajarkan.</td>
                        <td><input class="form-check-input" type="radio" value="4" name="penambahan[]" required></td>
                        <td><input class="form-check-input" type="radio" value="3" name="penambahan[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="penambahan[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="penambahan[]"></td>
                    </tr>
                    <tr>
                        <td>Kelayakan penyajian materi yang diberikan (Audio/visual/audiovisual/peralatan lain yang
                            digunakan)
                        </td>
                        <td><input class="form-check-input" type="radio" value="4" name="kelayakan[]" required></td>
                        <td><input class="form-check-input" type="radio" value="3" name="kelayakan[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="kelayakan[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="kelayakan[]"></td>
                    </tr>
                    <tr>
                        <td>Kelayakan akomodasi/konsumsi/fasilitas training yang diberikan
                        </td>
                        <td><input class="form-check-input" type="radio" value="4" name="kelayakan_akomodasi[]"
                                required>
                        </td>
                        <td><input class="form-check-input" type="radio" value="3" name="kelayakan_akomodasi[]"></td>
                        <td><input class="form-check-input" type="radio" value="2" name="kelayakan_akomodasi[]"></td>
                        <td><input class="form-check-input" type="radio" value="1" name="kelayakan_akomodasi[]"></td>
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
                <textarea class="form-control mr-2" rows="3" placeholder="Enter ..."
                    name="perbaikan_program"></textarea>
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
                            <td><input class="form-control input-sm" type="text" name="instruktur1" required></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Pengetahuan/pemahaman instruktur terhadap materi training
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan1"
                                            value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan1"
                                            value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan1"
                                            value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan1"
                                            value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kemampuan dalam menjelaskan materi training
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan1"
                                            value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan1"
                                            value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan1"
                                            value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan1"
                                            value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_melibatkan1" value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_melibatkan1" value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_melibatkan1" value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_melibatkan1" value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_menanggapi1" value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_menanggapi1" value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_menanggapi1" value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_menanggapi1" value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Kemampuan mengendalikan penggunaan waktu
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_mengendalikan1" value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_mengendalikan1" value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_mengendalikan1" value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required
                                            name="kemampuan_mengendalikan1" value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
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
                <textarea class="form-control " rows="3" placeholder="Enter ..."
                    name="peningkatan_instruktur"></textarea>
            </div>
            <div class="form-group ">
                <label class="">Selama mengikuti training ini, insight (wawasan) apa yang anda dapatkan ? <span
                        style="color:red;">*</span></label>
                <textarea class="form-control " rows="3" placeholder="Enter ..." name="wawasan" required></textarea>
            </div>
        </div>
        <div>

            <div class="card ">
                <label class="">Seberapa banyak anda mendapatkan pengetahuan/skill baru dari training ini ? <span
                        style="color:red;">*</span></label>
                <div class="form-group d-flex justify-content-between p-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="skill[]" value="25" required>
                        <label class=" form-check-label">25</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="skill[]" value="50">
                        <label class="form-check-label">50</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="skill[]" value="75">
                        <label class="form-check-label">75</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="skill[]" value="100">
                        <label class=" form-check-label">100</label>
                    </div>
                </div>
            </div>
            <div class="">
                <label class="">Apakah anda akan merekomendasikan training ini kepada rekan kerja yang lain
                    ?<span style="color:red;">*</span></label>
                <div class="form-group d-flex justify-content-around p-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi[]" value="1" required>
                        <label class=" form-check-label">Ya</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi[]" value="2">
                        <label class="form-check-label">Tidak</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class=""> Training apa yang Anda butuhkan di masa yang akan datang, dan alasannya?</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="kebutuhan"></textarea>
            </div>
            <div class="d-flex justify-content-end m-3">
                <button type="submit" class="btn btn-primary btn-lm"><i class="fa fa-fw fa-send"></i>Send</button>

            </div>
        </div>
    </form>
</div>
<script>
function loop(i) {
    i++
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
                            <td><input class="form-control input-sm" type="text" name="instruktur${i}" required></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Pengetahuan/pemahaman instruktur terhadap materi training
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan${i}" value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan${i}" value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan${i}" value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="pengetahuan${i}" value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kemampuan dalam menjelaskan materi training
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan${i}" value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan${i}" value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan${i}" value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan${i}" value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_melibatkan${i}"
                                            value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_melibatkan${i}"
                                            value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_melibatkan${i}"
                                            value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_melibatkan${i}"
                                            value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_menanggapi${i}"
                                            value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_menanggapi${i}"
                                            value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_menanggapi${i}"
                                            value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_menanggapi${i}"
                                            value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Kemampuan mengendalikan penggunaan waktu
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_mengendalikan${i}"
                                            value="4">
                                        <label class="form-check-label">4 (Sangat Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_mengendalikan${i}"
                                            value="3">
                                        <label class="form-check-label">3 (Baik)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_mengendalikan${i}"
                                            value="2">
                                        <label class="form-check-label">2 (Cukup)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="kemampuan_mengendalikan${i}"
                                            value="1">
                                        <label class="form-check-label">1 (Kurang)</label>
                                    </div>
                                </div>
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

    }


}

function remove(i) {
    $('#remove' + i).closest('#' + i).remove();
}
</script>
<?= $this->endSection() ?>