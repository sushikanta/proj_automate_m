<?php require_once("check_login_admin.php"); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Update Business/Firm Information</title>
        <?php require_once("css_bootstrap_header.php"); ?>
    </head>
    <body>
    <?php require_once("right_top_header_admin.php"); ?>
    <div class="container">
        <div id="divWait" style="display: none;" class="row text-center">
            <img src="images/loading-1.gif" alt="Please wait...."
                 style="background-repeat:no-repeat; background-position:right center; margin-top:80px;"/>
        </div>
        <div class="page-content" id="div_main">

            <?php
            $stt_rec = getSettings($con);

            if (isset($_POST['dr_submit'])) {

                pr($_FILES);
                if(@$_FILES['logo']){
                    $file = $_FILES['logo'];
                    $target_dir = "images/logos/";
                    $target_file = $target_dir . basename($file["name"]);
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    $check = @getimagesize($file["tmp_name"]);
                    if($check !== false) {
//                        echo "File is an image - " . $check["mime"] . ".";
//                        $uploadOk = 1;

                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }else{
                            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                                $_POST['settings']['logo'] = $target_file;
                                //echo "The file ". basename($file["name"]). " has been uploaded.";
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }


                    } else {
                        echo "Invalid file uploaded for logo";

                    }
                }


                if(@$_POST['settings'] && is_array($_POST['settings'])){
                    $settings_arr = $_POST['settings'];
                    foreach ($settings_arr as $key => $val){
                        $stt_rec[$key] = $val;
                    }

                    updateSettings($con, $settings_arr);
                    header("location: settings.php");
                }
               
            }
            ?>

            <div class="inv-main">
                <form class="form-horizontal inv-form" role="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="panel panel-success"> <!-----------------START Doctor Information-------------->
                        <div class="panel-heading light_purple_color">
                            <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
                                Update Business Details
                                <span class="text-right pull-right" style="font-size:14px !important;"><i
                                        class="fa fa-calendar"></i> <span id="show_date"></span></span>
                            </h3>
                        </div>

                        <!-----ROW 1 -- -->
                        <div class="form-group">

                            <div class="form-control-group">
                                <label for="inputDoctor_name" class="col-lg-2 control-label">Business Title</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control capital" name="settings[business_title]" value="<?php echo @$stt_rec['business_title']['setting'] ?>"
                                           placeholder="Enter Business name" autofocus maxlength="100" required>
                                </div>
                            </div>

                            <div class="form-control-group">
                                <label for="inputDoctor_name" class="col-lg-2 control-label">Business Contact</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control capital" name="settings[business_contact]"  value="<?php echo @$stt_rec['business_contact']['setting'] ?>"
                                           placeholder="Enter Business Contact" autofocus maxlength="50" required>
                                </div>
                            </div>
                        </div>

                        <!-----ROW 2 -- -->
                        <div class="form-group">

                            <div class="form-control-group">
                                <label for="inputDoctor_name" class="col-lg-2 control-label">Registration No.</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control capital" name="settings[regd_no]"  value="<?php echo @$stt_rec['regd_no']['setting'] ?>"
                                           placeholder="Enter Regd. No" autofocus maxlength="100" required>
                                </div>
                            </div>

                            <div class="form-control-group">
                                <label for="inputDoctor_name" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control capital" name="settings[email]"  value="<?php echo @$stt_rec['email']['setting'] ?>"
                                           placeholder="Enter Email" autofocus maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <!-----ROW 3 -- -->


                        <div class="form-group">
                            <div class="form-control-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Address</label>
                                <div class="col-lg-3">
                                   <textarea name="settings[address]" style="width: 100%; height: 200px"><?php echo @$stt_rec['address']['setting'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-control-group">
                                <label for="inputDoctor_name" class="col-lg-2 control-label">Logo</label>
                                <div class="col-lg-3">
                                    <?php if(@$stt_rec['logo']['setting']): ?>
                                        <img style="height: 100px;margin-bottom: 10px;" src="<?php echo @$stt_rec['logo']['setting']; ?>">
                                    <?php endif; ?>
                                    <input type="file" class="form-control capital" name="logo"  value="<?php echo @$stt_rec['logo']['setting'] ?>">
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-4">
                            <button type="submit" class="btn btn-primary btn-block" id="dr_submit" name="dr_submit"
                                    style="font-size:16px;">Submit
                            </button>
                        </div>
                    </div>
                </form> <!--------------  form end  -------------->

                <div class="clear"></div>
            </div>
            <?php include("footer.php"); ?>
            <?php include("script_bootstrap.php"); ?>
      </body>
    </html>
<?php ob_flush() ?>