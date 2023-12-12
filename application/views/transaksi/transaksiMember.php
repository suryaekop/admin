<?php
                function generateKodeTransaksi() {
                // Logika untuk menghasilkan kode transaksi, bisa berdasarkan tanggal atau logika lainnya
                return 'TRX' . uniqid(); // Contoh sederhana, bisa disesuaikan
                }
                ?>
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
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?php echo form_open_multipart('transaksi/convert_and_update'); ?>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kodetransaksi">Kode Transaksi</label>
                    <div class="col-md-6">
                        <input type="text" id="kodetransaksi" name="kodetransaksi" class="form-control" value="<?= generateKodeTransaksi() ?>">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggaltransaksi">Tanggal Transaksi</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('tanggaltransaksi'); ?>" type="date" id="tanggaltransaksi" name="tanggaltransaksi" class="form-control" placeholder="tanggaltransaksi">
                        <?= form_error('tanggaltransaksi', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nocabang">No Cabang</label>
                    <div class="col-md-6">
                        <select name="nocabang" id="nocabang" class="form-control">
                            <?php
                            foreach ($cabang as $cg => $cbg){
                                ?>
                                <option value="<?= $cbg['id']?>"><?= $cbg['nocabang']?> | <?= $cbg['namacabang']?></option>
                                <?php
                                
                            }
                            ?>
                        </select>
                        <?= form_error('nocabang', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="idmember">Nama Member</label>
                    <div class="col-md-6">
                        <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="idmember" id="idmember" value="<?=$data['id']?> | <?=$data['namamember']?> ">
                                <?php
                            }
                        }
                        ?>
                        
                        <?= form_error('idmember', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="total">Total</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('total'); ?>" type="text" id="total" name="total" class="form-control" placeholder="total">
                        <?= form_error('total', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                
            
    

                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>