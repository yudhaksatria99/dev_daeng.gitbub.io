        <form id="formActions" role="form" action="<?= base_url('api/APIInformasi/edit')?>">
            <div class="row">         
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Sumber Informasi</label>
                        <textarea name="name" class="form-control" required rows="3"><?= $info->informasi ?></textarea>
                    </div>
                </div>
				
				<div class="col-md-3">
                    <div class="form-group">
                        <label>Active?</label>
							<div class="radio">
							<label>
								<input type="radio" name="is_active" id="optionsRadios1" value="1" <?php if ($info->is_active == 1) echo ' checked'?>>Yes &nbsp;
							</label>
							<label>
								<input type="radio" name="is_active" id="optionsRadios2" value="0" <?php if ($info->is_active == 0) echo ' checked'?>>No
							</label>
						</div>						   
                    </div>
                </div>
				
                 
            </div>
            
            <div class="row">
				<div class="col-md-12">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<input type="hidden" name="id" value="<?= $info->informasi_id ?>">
								<button type="submit" class="btn btn-success">Update</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>