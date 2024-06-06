<div class="container"> 
    <center>
    <table> 
            <tr> 
                <td> <div class="table-responsive full-width"> 
                    <table class="table table-bordered table-striped table-hover" id="table-datatable"> 
                        <tr> 
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Fasilitas</th> 
                            <th>Penanggung Jawab</th> 
                            <th>Lokasi</th> 
                            <th>Kuota</th>
                            <th>Pilihan</th> 
                        </tr> 
                        <?php $no = 1; foreach ($temp as $t) { ?> 
                        <tr>
                            <td><?= $no; ?></td> 
                            <td> <img src="<?= base_url('assets/img/upload/' . $t['image']); ?>" class="rounded" alt="No Picture" width="40%"> </td>
                            <td nowrap><?= $t['nama_fasilitas']; ?></td> 
                            <td nowrap><?= $t['penanggung_jawab']; ?></td> 
                            <td nowrap><?= $t['lokasi']; ?></td> 
                            <td nowrap><?= $t['kuota']; ?></td>
                            <td nowrap> <a href="<?= base_url('booking/hapusbooking/' . $t['id_fasilitas']); ?>" onclick="return_konfirm('Yakin tidak Jadi Booking '.$t['nama_fasilitas'])"><i class="btn btn-sm btn-outline-danger fas fw fa-trash"></i></a> </td> 
                        </tr> 
                        <?php $no++; } ?> 
                    </table> 
                </div> 
            </td> 
        </tr> 
        <tr> 
            <td colspan="3"> <hr> </td> 
        </tr> 
        <tr>
            <td colspan="3"> 
                <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url(); ?>"><span class="fas fw fa-play"></span> Lanjutkan Booking Fasilitas</a> 
                <a class="btn btn-sm btn-outline-success" href="<?php echo base_url() . 'booking/bookingSelesai/' . $this->session->userdata('id_user'); ?>"><span class="fas fw fa-stop"></span> Selesaikan Booking</a> 
            </td> 
        </tr> 
    </table> 
</center> 
</div>
