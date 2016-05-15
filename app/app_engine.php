<?php
function create_unique($options = []) {
    // options = [generate][ktype]
    $var_app_version = 'automate-m-v-1';

    ob_start();
    system('ipconfig /all');
    $mycom=ob_get_contents();
    ob_clean();
    $findme = "Physical";
    $pmac = strpos($mycom, $findme);
    $secret_key =substr($mycom,($pmac+36),17);
    $var_app_type_arr = [
        '15' => 'gGxEd7rxMP',
        '30' => 'Un9wDQE6i2',
        '90' => 'O6zSVzJJpr',
        '365' => '8C31LazG05',
        '730' => '3KY8AG8Sb6',
        '1' => 'YN29tx8p2F',
    ];
    $var_app_type = isset($options['ktype'])?$options['ktype']:'Un9wDQE6i2';

    if(isset($options['generate'])){
        $data = $var_app_version.$var_app_type;
        return hash_hmac('sha256',$data,$secret_key);
    }

    if(isset($options['key'])){
        $result = 15;
        foreach ($var_app_type_arr AS $key => $item){
            $data = $var_app_version.$item;
            $possible_key = hash_hmac('sha256',$data,$secret_key);
            if($possible_key == $options['key']){
               return $key;
            }
        }
        return $result;
    }
}


ob_start();
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();
$findme = "Physical";
$pmac = strpos($mycom, $findme);
$secret_key =substr($mycom,($pmac+36),17);
echo $new_string = str_replace('-','', $secret_key);
$variable = str_split($new_string, 4);
echo implode('-', $variable);
print_r($variable);
// Echo out the hashed data - This will be different every time.
$newhash = create_unique(['generate' => true, 'ktype' =>'Un9wDQE6i2']);
$newhash2 = create_unique(['key' => 'bca7d300ef660b7e09c77db1b6efd4dc5c9e1cd2e126d6daed524b2745faf770']);

echo "<pre>{$newhash}</pre>";
echo "<pre>{$newhash2}</pre>";

$str = 'MjAxNi0wNC0yOCAyMzoxMDowOA==';
echo $decoded = base64_decode($str);
//echo base64_encode("This is an encoded string");
//$date_string = date('Y-m-d H:i:s');
//$encoded_string = base64_encode($date_string);
//$decoded_string = base64_decode($encoded_string);
//echo $decoded_string;
$date = $decoded;
$date = '2016-04-28 23:10:99';
$d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
if($d && $d->format('Y-m-d H:i:s') === $date){
    echo 'yes its correct format';
}else{
    echo 'no it is bad date';
}
?>

