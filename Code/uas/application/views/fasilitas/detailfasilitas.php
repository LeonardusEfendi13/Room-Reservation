<div class="x_panel" align="center">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <div class="thumbnail" style="height: auto; position: relative; left: 100%; width: 200%;">
                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $gambar; ?>" style="max-width:100%; max-height: 100%; height: 150px; width: 120px">
                    <div class="caption">
                        <h5 style="min-height:40px;" align="center"><?= $nama ?></h5>
                        <center>
                            <table class="table table-stripped">
                                <tr>
                                    <th nowrap>Penanggung Jawab: </th>
                                    <td nowrap><?= $penanggung; ?></td>
                                    <td>&nbsp;</td>
                                    <th>Kategori: </th>
                                    <td><?= $kategori ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>Lokasi: </th>
                                    <td><?= $lokasi ?></td>
                                    <td>&nbsp;</td>
                                    <th>Dipakai: </th>
                                    <td><?= $dipakai ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>Luas: </th>
                                    <td><?= $luas ?></td>
                                    <td>&nbsp;</td>
                                    <th>Dibooking: </th>
                                    <td><?= $dibooking ?></td>
                                </tr>
                                <tr>
                                    <th>Kuota: </th>
                                    <td><?= $kuota ?></td>
                                    <td>&nbsp;</td>
                                    <th>Tersedia: </th>
                                    <td><?= $stock ?></td>
                                </tr>
                            </table>
                        </center>
                        <p><a class="btn btn-outline-primary fas fw fa-shopping-cart" href="<?= base_url('booking/tambahBooking/' . $id); ?>"> Booking</a> <span class="btn btn-outline-secondary fas fw fa-reply" onclick="window.history.go(-1)"> Kembali</span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>