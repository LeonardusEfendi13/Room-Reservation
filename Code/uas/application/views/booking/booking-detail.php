<div class="container">
    <center>
        <table>
            <?php foreach ($agt_booking as $ab) {
            ?>
                <tr>
                    <td>Data Anggota</td>
                    <td>:</td>
                    <th><?= $ab['nama']; ?></th>
                </tr>
                <tr>
                    <td>ID Booking</td>
                    <td>:</td>
                    <th><?= $ab['id_booking']; ?></th>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No.</th>
                                <th>ID Fasilitas</th>
                                <th>Nama Fasilitas</th>
                                <th>Penanggung Jawab</th>
                                <th>Lokasi</th>
                                <th>Kuota</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($detail as $d) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d['id_fasilitas']; ?></td>
                                    <td><?= $d['nama_fasilitas']; ?></td>
                                    <td><?= $d['penanggung_jawab']; ?></td>
                                    <td><?= $d['lokasi']; ?></td>
                                    <td><?= $d['kuota']; ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <a href="#" onclick="window.history.go(-1)" class="btn btn-outline-dark"><i class="fas fa-fw fa-reply"></i> Kembali</a>
                </td>
            </tr>
        </table>
    </center>
</div>