<div class="container">
    <center>
        <table>
            <tr>
                <td>
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No Pakai</th>
                                <th>Tanggal Pemakaian</th>
                                <th>ID User</th>
                                <th>ID Fasilitas</th>
                                <th>Tanggal Selesai</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Terlambat</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Total Denda</th>
                                <th>Pilihan</th>
                            </tr>
                            <?php foreach ($pakai as $p) {
                            ?>
                                <tr>
                                    <td><?= $p['no_pakai']; ?></td>
                                    <td><?= $p['tgl_pakai']; ?></td>
                                    <td><?= $p['id_user']; ?></td>
                                    <td><?= $p['id_fasilitas']; ?></td>
                                    <td><?= $p['tgl_kembali']; ?></td>
                                    <td>
                                        <?= date('Y-m-d'); ?>
                                        <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                    </td>
                                    <td>
                                        <?php $tgl1 = new DateTime($p['tgl_kembali']);
                                        $tgl2 = new DateTime();
                                        $selisih = $tgl2->diff($tgl1)->format("%a");
                                        echo $selisih; ?> Hari </td>
                                    <td>
                                        <?= $p['denda']; ?>
                                    </td>
                                    <?php
                                    if ($p['status'] == "Pakai") {
                                        $status = "warning";
                                    } else {
                                        $status = "secondary";
                                    }
                                    ?>
                                    <td>
                                        <i class="btn btn-outline-<?= $status; ?> btn-sm"><?= $p['status']; ?></i>
                                    </td>
                                    <?php
                                    if ($selisih < 0) {
                                        $total_denda = $p['denda'] * 0;
                                    } else {
                                        $total_denda = $p['denda'] * $selisih;
                                    }
                                    ?>
                                    <td>
                                        <?= $total_denda; ?> <input type="hidden" name="totaldenda" id="totaldenda" value="<?= $total_denda; ?>">
                                    </td>
                                    <td nowrap>
                                        <?php
                                        if ($p['status'] == "Kembali") {
                                        ?>
                                            <i class="btn btn-sm btn-outline-secondary"><i class="fas fa-fw fa-edit"></i>Ubah Status</i>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn btn-sm btn-outline-info" href="<?= base_url('pakai/ubahStatus/' . $p['id_fasilitas'] . '/' . $p['no_pakai']); ?>">
                                                <i class="fas fa-fw fa-edit"></i>Ubah Status</a>
                                            <!--<a class="btn btn-sm btn-outline-info" href="<?= base_url('pakai/hapusTransaksi/' . $p['id_fasilitas'] . '/' . $p['no_pakai']); ?>">
                                                <i class="fas fa-fw"></i>Delete</a>-->
                                                
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </center>
</div>