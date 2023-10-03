        <form id="formActions" role="form" action="<?= base_url('api/APIOtherapp/edit') ?>">
			<div class="row">
				<div class="col-md-6">
        			<div class="form-group">
        				<label>App Name</label>
        				<input name="judul" type="text" value="<?= $otherapp->judul ?>" class="form-control" placeholder="App Name" required>
        			</div>
        		</div>
        	
        		<div class="col-md-6">
        			<div class="form-group">
        				<label>Icon</label>
						<input id="iconxUpload" name="iconx" type="file" class="form-control">
        				<div id="iconxr-holder"><img class="img-responsive" src="<?= base_url('uploads/150/') . $otherapp->path_img ?>"> </div>
        			</div>
        		</div>
        	
        	</div>
        	<div class="row">
				<div class="col-md-6">
        			<div class="form-group">
        				<label>Link</label>
        				<input name="link" type="text" value="<?= $otherapp->link ?>" class="form-control" placeholder="Link" maxlength="200" required>
        			</div>
        		</div>
				<div class="col-md-3">
        			<div class="form-group">
        				<label>Param NIK</label>
        				<input name="nik" type="text" value="<?= $otherapp->nik ?>" class="form-control" placeholder="Param NIK"  maxlength="50">
        			</div>
        		</div>
				<div class="col-md-3">
        			<div class="form-group">
        				<label>Param Pwd</label>
        				<input name="password" type="text" value="<?= $otherapp->password ?>" class="form-control" placeholder="Param Password" maxlength="50">
        			</div>
        		</div>
				
			</div>
			<div class="row">
				<div class="col-md-3">
        			<div class="form-group">
        				<label>Param Store</label>
        				<input name="store" type="text" value="<?= $otherapp->store ?>" class="form-control" placeholder="Param Store" maxlength="50">
        			</div>
        		</div>
				<div class="col-md-3">
        			<div class="form-group">
        				<label>Last Param</label>
        				<input name="suffix" type="text" value="<?= $otherapp->suffix ?>" class="form-control" placeholder="Last Param" maxlength="50">
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="form-group">
        				<label>Active?</label>
        				<div class="radio">
        					<label>
        						<input type="radio" name="is_active" id="optionsRadios1" value="1" <?php if ($otherapp->is_active == 1) echo ' checked' ?>>Yes &nbsp;
        					</label>
        					<label>
        						<input type="radio" name="is_active" id="optionsRadios2" value="0" <?php if ($otherapp->is_active == 0) echo ' checked' ?>>No
        					</label>
        				</div>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="form-group">
        				<label>&nbsp;</label>
        				<div>
        					<label>
        						<input type="hidden" name="id" value="<?= $otherapp->id ?>" />
        						<button type="submit" class="btn btn-success">Update</button>
        					</label>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>
		<script>
            $("#iconxUpload").on('change', function() {

                //Get count of selected files
                var countFiles = $(this)[0].files.length;

                var imgPath = $(this)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $("#iconxr-holder");
                image_holder.empty();

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof(FileReader) != "undefined") {

                        //loop for each file selected for uploaded.
                        for (var i = 0; i < countFiles; i++) {

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "img-responsive"
                                }).appendTo(image_holder);
                            }

                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[i]);
                        }

                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Pls select only images");
                }
            });

   
        </script>