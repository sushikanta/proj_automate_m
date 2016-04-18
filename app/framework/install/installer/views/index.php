<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Install <?php echo $this->config->item('app_name'); ?></title>
<link href="<?php echo base_url('../assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('../assets/css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('../assets/js/jquery-2.1.3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('../assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" >
    $(function(){
        $(".js-btn-install").on('click', function(e){
            var _this  = $(this);

            _this.addClass('disabled').fadeOut("slow", function(){
                _this.closest("form").find(".js-gear-container").fadeIn();
            });
    });
    });

</script>
</head>

<body>



<div class="container">
    <div class="page-header">
        <h2>Welcome to <?php echo $this->config->item('app_name'); ?></h2>
    </div>


    <div class="alert alert-warning">
        <p>
           Below information will be used throught the application including the generated reports.<br>
        </p>

    </div>

    <?php if(isset($errors))
    {
        echo $errors;
    }
    ?>


    <form action="<?php echo base_url();?>" method="post" accept-charset="utf-8">
        <input type="hidden" name="hostname" value="<?php echo $this->config->item('host'); ?>">
        <input type="hidden" name="database" value="<?php echo $this->config->item('database_name'); ?>">
        <input type="hidden" name="username" value="<?php echo $this->config->item('database_user'); ?>">
        <input type="hidden" name="password" value="<?php echo $this->config->item('database_password'); ?>">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <label for="hostname-label">Business/Firm Title</label>
                    <?php echo form_input(['name'=>'business_title', 'class'=>'form-control', 'value'=>set_value('business_title')]);?>
                </div>
                <div class="form-group">
                    <label for="hostname-label">Registration No.</label>
                    <?php echo form_input(['name'=>'regd_no', 'class'=>'form-control', 'value'=>set_value('regd_no', '')]);?>
                </div>
                <div class="form-group">
                    <label for="hostname-label">Contact No.</label>
                    <?php echo form_input(['name'=>'business_contact', 'class'=>'form-control', 'value'=>set_value('business_contact', '')]);?>
                </div>
                <div class="form-group">
                    <label for="hostname-label">Email ID</label>
                    <?php echo form_input(['name'=>'email', 'class'=>'form-control', 'value'=>set_value('email', '')]);?>
                </div>
                <div class="form-group">
                    <label for="hostname-label">Address</label>
                    <?php echo form_textarea(['name'=>'address', 'class'=>'form-control', 'value'=>set_value('address')]);?>
                </div>

       <!--         <div class="form-group">
                    <label for="database-name-label">Database Name</label>
                    <?php /*echo form_input(['name'=>'database', 'class'=>'form-control', 'value'=>set_value('database', 'db_automate_m')]);*/?>
                </div>
                <div class="form-group">
                    <label for="control-label">Username</label>
                    <?php /*echo form_input(['name'=>'username', 'class'=>'form-control', 'value'=>set_value('username', 'root')]);*/?>
                </div>
                <div class="form-group">
                    <label for="password-label">Password</label>
                    <?php /*echo form_input(['name'=>'password', 'class'=>'form-control', 'value'=>set_value('password')]);*/?>
                </div>-->

                <!--<div class="form-group">
                    <label for="database-prefix-label">Database Table Prefix (ex. gc_)</label>
                    <?php /*echo form_input(['name'=>'prefix', 'class'=>'form-control', 'value'=>set_value('prefix')]);*/?>
                </div>
-->
                <div class="alert alert-warning">
                    <p>
                       Preserve previously installed  database <input style="margin-left: 10px" checked type="checkbox" name="preserve_db" value="true">
                    </p>
                </div>
                <button id="btn_step1" class="btn btn-primary js-btn-install" type="submit">Install</button>

            </div>

        </div>
        <div class="text-center js-gear-container" style="display: none">
                 <span>
<img src="<?php echo base_url('../assets/img/gears.gif');?>"> Please sit back while the database is setting up for your business. This should be done in a few minutes..
                     </span>
        </div>
    </form>

</div>

<footer>
    <div class="container">
        <div style="text-align:center">
           <br>
           <br>
           <br>
        </div>
    </div>
</footer>

</body>
</html>
