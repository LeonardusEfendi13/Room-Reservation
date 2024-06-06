<div class="container"> 
    <center> 
        <table> <?php foreach ($useraktif as $u) { ?> 
            <tr> 
                <td nowrap>Terima Kasih <b><?= $u->nama; ?></b> </td> 
            </tr> 
            <tr> 
                <td>Fasilitas yang ingin Anda Sewakan:</td> 
            </tr> 
            <?php } ?> 
            <tr> 
                <td> <div class="table-responsive"> <table class="table table-bordered table-striped table-hover" id="table-datatable"> 
                    <tr> 
                        <th>No.</th>
                        <th>Gambar</th> 
                        <th>Fasilitas</th> 
                        <th>Penanggung Jawab</th> 
                        <th>Lokasi</th> 
                        <th>Kuota</th>
                        </tr> 
                    <?php $no = 1; foreach ($items as $i) { ?> 
                        <tr> 
                            <td><?= $no; ?></td> 
                            <td> <img src="<?= base_url('assets/img/upload/' . $i['image']); ?>" class="rounded" alt="No Picture" width="10%"> </td> 
                            <td nowrap><?= $i['nama_fasilitas']; ?></td>
                            <td nowrap><?= $i['penanggung_jawab']; ?></td>
                            <td nowrap><?= $i['lokasi']; ?></td>
                            <td nowrap><?= $i['kuota']; ?></td> 
                        </tr> 
                        <?php $no++; } ?> 
                    </table> 
                </div> 
            </td> 
        </tr> 
        <tr> 
            <td> <hr> </td> 
        </tr> 
        <tr> 
            <td> <a class="btn btn-sm btn-outline-danger" onclick="information('Waktu Pengambilan Fasilitas 1x24 jam dari Booking!!!')" href="<?= base_url('home'); ?>"><span class="far fa-lg fa-fw"></span>Go to Home</a> </td> 
        </tr> 
    </table> 
</center> 
</div>
