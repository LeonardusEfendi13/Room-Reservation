<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- row ux-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Anggota</div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('user/anggota'); ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6  mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Fasilitas Terdaftar</div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['stock != 0'];
                                $totalstok = $this->ModelFasilitas->total('stock', $where);
                                //echo $totalstok
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('fasilitas'); ?>"><i class="fas fa-book fa-3x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Fasilitas yang dibooking</div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('booking'); ?>"><i class="fas fa-shopping-cart fa-3x text-danger"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row ux-->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--  row table-->
    <div class="row">
        <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
            <div class="page-header">
                <span class="fas fa-book text-warning mt-2">Data Fasilitas</span>
                <a href="<?= base_url('fasilitas'); ?>"><i class="fas fa-search text-primary mt-2 float-right">Tampilkan</i></a>
            </div>
            <div class="table-responsive">
                <table class="table mt-3" id="table-datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Fasilitas</th>
                            <th>Penanggung Jawab</th>
                            <th>Lokasi</th>
                            <th>Luas Area</th>
                            <th>Stock</th>
                            <th>Kuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($fasilitas as $f) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $f['nama_fasilitas']; ?></td>
                                <td><?= $f['penanggung_jawab']; ?></td>
                                <td><?= $f['lokasi']; ?></td>
                                <td><?= $f['luas_area']; ?></td>
                                <td><?= $f['stock']; ?></td>
                                <td><?= $f['kuota']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- end of row table-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->