<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <form method="post" action="<?= base_url() ?>/send_evaluasi_reaksi">
        <div class="d-flex justify-content-center">
            <h4>Evaluasi Program Pelatihan</h4>
        </div>
        <div class="card m-2 p-2">
            <label>
                Nama Training<span> :<?= " " ?></span>
            </label>
            <label>
                Nama<span> :<?= " " . $nama ?></span>
            </label>
            <label>
                Npk<span> :<?= " " . $npk ?></span>
            </label>
            <label>
                Dept<span> :<?= " " . $bagian ?></span>
            </label>
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
                    <td><input class="form-check-input" type="radio" value="4" name="program[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="program[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="program[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="program[]"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tampilan hand-out bahan</td>
                    <td><input class="form-check-input" type="radio" value="4" name="tampilan[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="tampilan[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="tampilan[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="tampilan[]"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Isi program training</td>
                    <td><input class="form-check-input" type="radio" value="4" name="program_training[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="program_training[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="program_training[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="program_training[]"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Kesesuaian metode training dengan topik yang dibahas (pengguna contoh/latihan/diskusi/studi
                        kasus/outbound/games, untuk pemahaman)</td>
                    <td><input class="form-check-input" type="radio" value="4" name="metode[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="metode[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="metode[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="metode[]"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Penambahan keterampilan/pengetahuan dari program training yang diajarkan.</td>
                    <td><input class="form-check-input" type="radio" value="4" name="penambahan[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="penambahan[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="penambahan[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="penambahan[]"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kelayakan penyajian materi yang diberikan (Audio/visual/audiovisual/peralatan lain yang
                        digunakan)
                    </td>
                    <td><input class="form-check-input" type="radio" value="4" name="kelayakan[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="kelayakan[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="kelayakan[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="kelayakan[]"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Kelayakan akomodasi/konsumsi/fasilitas training yang diberikan
                    </td>
                    <td><input class="form-check-input" type="radio" value="4" name="kelayakan_akomodasi[]"></td>
                    <td><input class="form-check-input" type="radio" value="3" name="kelayakan_akomodasi[]"></td>
                    <td><input class="form-check-input" type="radio" value="2" name="kelayakan_akomodasi[]"></td>
                    <td><input class="form-check-input" type="radio" value="1" name="kelayakan_akomodasi[]"></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group m-3">
            <label class="ml-2">Hal-hal apa saja dari isi program yang telah memenuhi harapan anda ?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="harapan"></textarea>
        </div>
        <div class="form-group m-3">
            <label class="ml-2">Hal-hal yang perlu diperbaiki/ditingkatkan dari isi program ?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="perbaikan_program"></textarea>
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
                    <td><input class="form-control input-sm" type="text" name="instruktur1"></td>
                    <td><input class="form-control input-sm" type="text" name="instruktur2"></td>
                    <td><input class="form-control input-sm" type="text" name="instruktur3"></td>
                    <td><input class="form-control input-sm" type="text" name="instruktur4"></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Pengetahuan/pemahaman instruktur terhadap materi training
                    </td>
                    <td><input class="form-control input-sm" type="text" name="pengetahuan1"></td>
                    <td><input class="form-control input-sm" type="text" name="pengetahuan2"></td>
                    <td><input class="form-control input-sm" type="text" name="pengetahuan3"></td>
                    <td><input class="form-control input-sm" type="text" name="pengetahuan4"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kemampuan dalam menjelaskan materi training
                    </td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan1"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan2"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan3"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan4"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kemampuan melibatkan partisipasi peserta dalam proses belajar
                    </td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan1"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan2"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan3"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_melibatkan4"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Kemampuan menanggapi permasalahan dan pertanyaan peserta
                    </td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi1"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi2"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi3"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_menanggapi4"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Kemampuan mengendalikan penggunaan waktu
                    </td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan1"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan2"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan3"></td>
                    <td><input class="form-control input-sm" type="text" name="kemampuan_mengendalikan4"></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group m-3">
            <label class="ml-2">Hal-hal apa saja dari Instruktur yang telah memenuhi harapan anda?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="harapan_instruktur"></textarea>
        </div>
        <div class="form-group m-3">
            <label class="ml-2">Hal-hal yang perlu diperbaiki/ditingkatkan dari Instruktur?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..."
                name="peningkatan_instruktur"></textarea>
        </div>
        <div class="form-group m-3">
            <label class="ml-2">Selama mengikuti training ini, insight (wawasan) apa yang anda dapatkan ?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="wawasan"></textarea>
        </div>
        <div class="card m-3">
            <label>Seberapa banyak anda mendapatkan pengetahuan/skill baru dari training ini ?</label>
            <div class="form-group d-flex justify-content-between p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill[]" value="25>
                    <label class=" form-check-label">25</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill[]" value="50">
                    <label class="form-check-label">50</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill[]" value="75>
                    <label class=" form-check-label">75</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="skill[]" value="100>
                    <label class=" form-check-label">100</label>
                </div>
            </div>
        </div>
        <div class="card m-3">
            <label>Apakah anda akan merekomendasikan training ini kepada rekan kerja yang lain ?</label>
            <div class="form-group d-flex justify-content-around p-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi[]" value="true">
                    <label class=" form-check-label">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rekomendasi[]" value="false">
                    <label class="form-check-label">Tidak</label>
                </div>
            </div>
        </div>
        <div class="form-group m-3">
            <label class="ml-2"> Training apa yang Anda butuhkan di masa yang akan datang, dan alasannya?</label>
            <textarea class="form-control m-2" rows="3" placeholder="Enter ..." name="kebutuhan"></textarea>
        </div>
        <div class="d-flex justify-content-end m-3">
            <button type="submit" class="btn btn-primary btn-lm"><i class="fa fa-fw fa-send"></i>Send</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?><div class="container">