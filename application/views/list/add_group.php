        <form id="formActions" role="form" action="<?= base_url('api/APIListGroup/add')?>">
            <div class="row">         
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Group Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Group Name" maxlength="20" required>
                    </div>
                </div>
				<div class="col-md-2">
                    <div class="form-group">
						<label>Seq</label>
						<input name="seq" type="number" class="form-control" placeholder="Seq" maxlength="7" required>
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
						<label>Choose Icon</label>
						<input id="fileUpload" name="icon" type="file" accept="image/*" required>
						<p class="help-block">Size width 512px, height 512px</p>
					</div>
					<div class="form-group"> 
                        <div id="image-holder"></div>
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
<script>
    $("#fileUpload").on('change', function () {

    //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = new Image();
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                        //Validate the File Height and Width.
                        image.onload = function () {
                            var height = this.height;
                            var width = this.width;
                            if (width > 512 || height > 512) {
                                alert('Gambar tidak sesuai!, ' + width + 'x'+ height);
                                return false;
                            }
                        };

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