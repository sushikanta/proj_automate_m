<?php  
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
*/

mysqli_report(MYSQLI_REPORT_STRICT);

try
{
    $con = mysqli_connect("localhost", "root", "", "automate_m"); //august update for escent
}
catch (Exception $e )
{
    echo '<div class="alert alert-danger" role="alert">There was an error connecting to the database.</div>';
    return;
}
?>

