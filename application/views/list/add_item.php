<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Item</h1>
    </div>
</div><!--/.row-->
        
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><label>Group <?= $group_name ?></label></div>
            <div class="panel-body">        
            <form id="formActions" role="form" method="post" action="<?= base_url('api/APIListItem/add')?>">
                <div class="row"> 
                    
                    <div class="col-md-6">   
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="2" maxlength="1000" required></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <?php foreach($category as $c): ?>
                                <option value="<?= $c->category_id ?>"><?= $c->category_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Departement</label>
                            <select name="departement" class="form-control">
                                <?php foreach($departement as $d): ?>
                                <option value="<?= $d->dept_id ?>"><?= $d->dept_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="row">     
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Rekomendasi</label>
                            <select name="rekomendasi" data-live-search="true" class="selectpicker form-control" data-dropup-auto="false">
                                <?php foreach($rekomendasi as $r): ?>
                                <option  value="<?= $r->rekomendasi_id ?>"><?= $r->rekomendasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>       
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bobot</label>
                            <input name="bobot" value="1" type="number" class="form-control" maxlength="3">
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Sumber Informasi</label>
                            <select name="informasi" data-live-search="true" class="selectpicker form-control" data-dropup-auto="false" >
                                <?php foreach($info as $i): ?>
                                <option value="<?= $i->informasi_id ?>"><?= $i->informasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-7">   
                        <div class="form-group">
                            <label>Choose Image</label>
                            <input id="fileUpload" name="image" type="file" accept="image/*">
                            <p class="help-block">Size width 512px, height 256px</p>
                        </div>
                        <div class="form-group"> 
                            <div id="image-holder"></div>
                        </div>
                    </div>
                   
                    <div class="form-group col-md-3">
                        <label>Effective Date</label>
                        <div class="input-group date" data-provide="datepicker" data-date-format= "yyyy-mm-dd">
                            <input type="text" class="form-control" name="effective_date" value="<?= date('Y-m-d')?>" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">   
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <label>
                                    <input type="hidden" name="group" value="<?= $group_id ?>" />
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                
            </form>
            

            </div>
        </div>	
    </div>
</div><!--/.row-->		

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

                        var img = new Image();
                        //Set the Base64 string return from FileReader as source.
                        img.src = e.target.result;
                        //Validate the File Height and Width.
                        img.onload = function () {
                            var height = this.height;
                            var width = this.width;
                            if (width > 512 || height > 256) {
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