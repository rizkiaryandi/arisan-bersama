<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Arisan</h4>
        <p class="card-description">
            Inputkan data arisan dengan valid
        </p>
        <form action="<?=base_url('action/add-arisan')?>" method="POST" class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <?=$this->apl->csrf()?>
                    <div class="form-group">
                        <label for="title">Judul Arisan</label>
                        <input min="2" max="100" required type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea required class="form-control" id="description" name="description" rows="4"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="time_start">Waktu Mulai</label>
                        <input required type="date" class="form-control" id="time_start" name="time_start">
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="period">Periode Arisan</label>
                        <select required class="form-control" id="period" name="period">
                            <option value="">-- Pilih Periode</option>
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan">Bulanan</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="nominal">Pembayaran (Rp)</label>
                        <input required type="number" class="form-control" id="nominal" name="nominal">
                    </div>
                    <div class="form-group">
                        <label for="long_time">Lama pembayaran (Berapa kali)</label>
                        <input required type="number" class="form-control" id="long_time" name="long_time">
                    </div> 
                    <button type="submit" class="btn btn-primary btn-block">Tambah Arisan</button>
                </div>
            </div>
        </form>
    </div>
</div>