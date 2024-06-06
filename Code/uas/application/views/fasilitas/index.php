<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#fasilitasBaruModal">
                <i class="fas fa-file-alt"></i> Fasilitas Baru
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Penanggung Jawab</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Luas Area</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Kuota</th>
                        <th scope="col">DiPakai</th>
                        <th scope="col">DiBooking</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($fasilitas as $f) {
                    ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $f['nama_fasilitas']; ?></td>
                            <td><?= $f['penanggung_jawab']; ?></td>
                            <td><?= $f['lokasi']; ?></td>
                            <td><?= $f['luas_area']; ?></td>
                            <td><?= $f['stock']; ?></td>
                            <td><?= $f['kuota']; ?></td>
                            <td><?= $f['dipakai']; ?></td>
                            <td><?= $f['dibooking']; ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/jpeg">
                                    <img width="250" src="<?= base_url('assets/img/upload/') . $f['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                                </picture>
                            </td>
                            <td>
                                <a href="<?= base_url('fasilitas/ubahFasilitas/') . $f['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('fasilitas/hapusFasilitas/') . $f['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $f['nama_fasilitas']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<div class="modal fade" id="fasilitasBaruModal" tabindex="-1" role="dialog" aria-labelledby="fasilitasBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fasilitasBaruModalLabel">Tambah Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('fasilitas'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_fasilitas" name="nama_fasilitas" placeholder="Masukkan Fasilitas">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="penanggung_jawab" name="penanggung_jawab" placeholder="Masukkan penanggung jawab">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="lokasi" name="lokasi" placeholder="Masukkan lokasi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="luas_area" name="luas_area" placeholder="Masukkan luas area">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stock" name="stock" placeholder="Masukkan nominal stok">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kuota" name="kuota" placeholder="Masukkan jumlah kuota">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->