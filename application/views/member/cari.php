<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Member
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
    <div class="table-responsive">
        <!-- Tabel Data Member -->
        <table class="table table-striped dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Nama Member</th>
                    <th>Nomor Handphone</th>
                    <th>Email</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($members) :
                    foreach ($members as $member) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $member['namamember']; ?></td>
                            <td><?= $member['nomor']; ?></td>
                            <td><?= $member['email']; ?></td>
                            <td><?= $member['poin']; ?></td>
                            <td>
                                <a href="<?= base_url("member/detail/{$member['id']}")?>" class="btn btn-primary">Detail Member</a>
                                <a href="<?= base_url("member/edit/{$member['id']}")?>" class="btn btn-success">Edit Member</a>
                            </td>
                        </tr>
                    <?php endforeach;
                    else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Silahkan tambahkan user baru</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>