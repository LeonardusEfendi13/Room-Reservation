<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <?php foreach ($fasilitas as $f) { ?>
                <form action="<?= base_url('fasilitas/ubahFasilitas'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $f['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama_fasilitas" name="nama_fasilitas" placeholder="Masukkan Nama Fasilitas" value="<?= $f['nama_fasilitas']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <?php
                            foreach ($kategori as $k) { ?>
                            <option value="<?=$k['id_kategori'];?>" <?php if ($f['id_kategori'] == $k['id_kategori']) { echo "selected";}?>><?= $k['nama_kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="penanggung_jawab" name="penanggung_jawab" placeholder="Masukkan nama penanggung jawab" value="<?= $f['penanggung_jawab']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi" value="<?= $f['lokasi']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="luas_area" name="luas_area" placeholder="Masukkan Luas Area" value="<?= $f['luas_area']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stock" name="stock" placeholder="Masukkan Nominal Stock" value="<?= $f['stock']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kuota" name="kuota" placeholder="Masukkan Jumlah Kuota" value="<?= $f['kuota']; ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($f['image'])) { ?>
 
                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $f['image']; ?>">
 
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $f['image']; ?>" class="rounded mx-auto mb-3 d-blok" alt="...">
                            </picture>
 
                        <?php } ?>
 
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
