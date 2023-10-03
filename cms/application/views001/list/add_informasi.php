        <form id="formActions" role="form" action="<?= base_url('api/APIInformasi/add')?>">
            <div class="row">         
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Sumber Informasi</label>
                        <textarea name="name" class="form-control" required rows="3"></textarea>
                    </div>
                </div>
				<div class="col-md-3">
                    <div class="form-group">
                        <label>Active?</label>
							<div class="radio">
							<label>
								<input type="radio" name="is_active" id="optionsRadios1" value="1" checked>Yes &nbsp;
							</label>
							<label>
								<input type="radio" name="is_active" id="optionsRadios2" value="0">No
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
								<button type="submit" class="btn btn-primary">Submit</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>