        <form id="formActions" role="form" action="<?= base_url('api/APIBanner/edit')?>">
           
            <div class="row"> 
				<div class="col-md-6">   
					<div class="form-group">
						<label>Header Image</label>
						<div id="header-holder"><img class="img-responsive" src="<?= base_url('uploads/150/'). $banner->header ?>"> </div>
                    </div>
				</div>
				<div class="col-md-6">   
					 
					<div class="form-group">
						<label>Footer Image</label>
						<div id="footer-holder"><img class="img-responsive" src="<?= base_url('uploads/150/'). $banner->footer ?>"> </div>
                    </div>
				</div>
                
            </div>
            <div class="row">
				<div class="col-md-6">
                    <div class="form-group">
                        <label>Banner Name</label>
                        <input name="name" type="text" value="<?= $banner->banner_name ?>" class="form-control" placeholder="Banner Name" readonly >
                    </div>
                </div> 
				<div class="col-md-3">
                    <div class="form-group">
                        <label>Active?</label>
							<div class="radio">
							<label>
								<input type="radio" name="is_active" id="optionsRadios1" value="1" <?php if ($banner->is_active == 1) echo ' checked'?>>Yes &nbsp;
							</label>
							<label>
								<input type="radio" name="is_active" id="optionsRadios2" value="0" <?php if ($banner->is_active == 0) echo ' checked'?>>No
							</label>
						</div>						   
                    </div>
                </div>
				<div class="col-md-3">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<input type="hidden" name="id" value="<?= $banner->banner_id ?>" />
								<button type="submit" class="btn btn-success">Update</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>
