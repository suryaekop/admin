<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form <?= $title; ?>
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('member') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <img src="<?= base_url() ?>assets/img/avatar/user.png" alt="User Cw" width="150" height="150">
                <br>
                <br>
                <table>
                    <tr>
                        <td>Nama Member</td>
                        <td>:</td>
                        <td><strong><?= $members['namamember'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td><strong><?= $members['nomor'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><strong><?= $members['alamat'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><strong><?= $members['email'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><strong><?= $members['jeniskelamin'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><strong><?= $members['tanggallahir'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><strong><?= $members['tempatlahir'] ?></strong></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
        <table class="table table-striped dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>No Cabang</th>
                    <th>Id Member</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                    foreach ($trans as $tr => $tran) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tran['kodetransaksi'] ?></td>
                            <td><?= $tran['tanggaltransaksi']; ?></td>
                            <td><?= $tran['nocabang']; ?></td>
                            <td><?= $tran['idmember']; ?></td>
                            <td><?= $tran['total']; ?></td>
                        </tr>
                        <?php
                    }?>
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>