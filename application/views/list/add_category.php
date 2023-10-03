        <form id="formActions" role="form" action="<?= base_url('api/APIListCategory/add')?>">
            <div class="row">         
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Category Name" maxlength="50" required>
                    </div>
                </div>
				<div class="col-md-5">
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