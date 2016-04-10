<?php echo '<?php  '; ?>

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
*/

mysqli_report(MYSQLI_REPORT_STRICT);

try
{
    $con = mysqli_connect("<?php echo $hostname;?>", "<?php echo $username;?>", "<?php echo $password;?>", "<?php echo $database;?>"); //august update for escent
}
catch (Exception $e )
{
    echo '<div class="alert alert-danger" role="alert">There was an error connecting to the database.</div>';
    return;
}
?>

