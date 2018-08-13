<?php session_start();
    header('Content-Type: text/html; charset=utf-8');

    if(isset($_REQUEST)){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($_REQUEST)."\r\n");        
    }else{
        echo "Invalid";
    }

    $api_id = $_REQUEST['api_id'];
    $api_secret_key = $_REQUEST['api_secret_key'];
    $price = (double)$_REQUEST['price'];
    $currency = (string)$_REQUEST['currency'];
    $quantity = $_REQUEST['quantity'];
    $total= $price * $quantity;
    $buyer_name  = $fullName= $_REQUEST['firstname']." ".$_REQUEST['lastname'];
    $card_name = $_REQUEST['card_name'];
    $fname = $_REQUEST['firstname'];
    $lname = $_REQUEST['lastname'];
    $product_name = empty($_REQUEST['product_name'])?0:(string)$_REQUEST['product_name'];
    $id_product = empty($_REQUEST['id_product'])?0:$_REQUEST['id_product'];
    $product_description = empty($_REQUEST['product_description'])?'':(string)$_REQUEST['product_description'];
    $country = $_REQUEST['country'];
    $city = $_REQUEST['city'];
    $zipcode = $_REQUEST['zipcode'];
    $email = $_REQUEST['email'];
    $address = $_REQUEST['address'];
    $phone = $_REQUEST['phone'];
    $payUToken = $_REQUEST['payUToken'];
    $error_url = $_REQUEST['error_url'];
    $failed_payment_return_page = $_REQUEST['failed_payment_return_page'];
    $success_url = $_REQUEST['success_url'];
    $order_number = $_REQUEST['order_number'];

    $time = strtotime(gmdate("Y-m-d\TH:i:s\Z"));
    
    $transaction_id = $time;

// echo "<pre>"; print_r($_REQUEST);

    ////////////////////////////// DB  Connect /////////////////////////////////////////////////////////////

    $servername = "localhost";
    $username = "payxtra";
    $password = "Webcraft!@#";
    $dbname = "payxtra";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    


  
  $card_number = preg_replace('/(?<=\d)\s+(?=\d)/', '', $_REQUEST['number']);   // remove the space character between number character

    $cust_exp_mon_yr = $_REQUEST['expiry'];
      $explode_mon_yr  = explode('/',$cust_exp_mon_yr);
      $card_expiry_month = $explode_mon_yr[0]; 
      $card_expiry_year = $explode_mon_yr[1];
  
  $card_holder_name = $_REQUEST['card_holder'];
  $card_number = $card_number;
  $exp_month = $card_expiry_month;
  $exp_year = $card_expiry_year;
  $cvv_code = $_REQUEST['cvc'];
  
 
  
  function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }
 function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 
$ua=getBrowser();
$yourbrowser= $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];


 $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

if(isset($_SERVER['HTTP_REFERER'])) {
     $actual_link =  $_SERVER['HTTP_REFERER'];
}

 $target_site = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
 




    ////////////////////////////////////////////////////////////////////////////////////////////////////

   
    define('MERCHANT_KEY', 'rjQUPktU');
    define('SALT', 'e5iIg1jwi8');
    define('PAYU_BASE_URL', 'https://test.payu.in');    //Testing url
    define('SUCCESS_URL', 'order-success.php');  //has complete url
    define('FAIL_URL', 'order-fail.php');    //add complete url 
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['phone'];
    $firstName = $_REQUEST['firstname'];
    $lastName = $_REQUEST['lastname'];
    $totalCost = (double)$_REQUEST['price'];
    $productinfo = empty($_REQUEST['product_description'])?'':(string)$_REQUEST['product_description'];
    $hash         = '';
    $hash_string = MERCHANT_KEY."|".$txnid."|".$totalCost."|".$productinfo."|".$firstName."|".$email."|||||||||||".SALT;
    $hash = strtolower(hash('sha512', $hash_string));

    /////////////////////////////////////////////////////////////////////////////////////////
?>

        <form action="https://test.payu.in/_payment" method="post" name="payuForm" id="payuForm">
            <input type="hidden" name="key" value="<?php echo MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input name="amount" type="number" value="<?php echo $totalCost; ?>" />
            <input type="text" name="firstname" id="firstname" value="<?php echo $firstName; ?>" />
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" />
            <input type="text" name="phone" value="<?php echo $mobile; ?>" />
            <textarea name="productinfo"><?php echo $productinfo; ?></textarea>
            <input type="text" name="surl" value="https://www.yupbee.com/paymentscore/cc5/post_payu.php" />
            <input type="text" name="furl" value="https://www.yupbee.com/paymentscore/cc5/post_payu.php"/>
            <input type="text" name="service_provider" value="payu_paisa"/>
            <input type="text" name="lastname" id="lastname" value="<?php echo $lastName ?>" />
            <input type="submit" name="" value="Pay">
        </form>
       


<?php 

die();
 if (isset($_POST['status'])) {
            // echo "<pre>"; 
            // print_r($_POST);
       if($_POST['status']=="success"){
       }else{
        
            $lastrow = "SELECT id  FROM user_transactions ORDER BY id DESC LIMIT 1";
            $res = $conn->query($lastrow);
            $id = mysqli_fetch_assoc($res);



            $que = $conn->query("UPDATE user_transactions SET status = 'Failed', description = '".$_POST['error_Message']."' WHERE id =".$id['id']);

            $return_output['status']='Failed';
            $return_output['message']=$_POST['error_Message'];
            echo json_encode($return_output);
            die();
       }

       
    }else{ 

        $sql = "INSERT INTO `MyGuests`( `ip`, `redirect_from`,`target_site`,  `browser`,`payment_by`) VALUES ('".get_client_ip()."','".$actual_link."','". $target_site."','".$yourbrowser."','payUmoeny')";
        $conn->query($sql);

        $stmt = $conn->query("INSERT INTO user_transactions (transaction_id, t_time, amt, curr, id_order, api_id, api_secret_key, form_id, first_name, last_name, buyer_name, card_name, email, phone, address, city, zipcode, country, status, gateway, bin_details) VALUES ('".$transaction_id."', '".$time."', '".$price."', '".$currency."', '".$id_product."', '".$api_id."', '".$api_secret_key."', '".$form_id."', '".$fname."', '".$lname."', '".$buyer_name."', '".$card_name."', '".$email."', '".$phone."', '".$address."', '".$city."', '".$zipcode."', '".$country."', 'Incomplete', 'payUmoeny', '".$bin_details."')");

        $user_transaction_id = $conn->insert_id;
        ?>

        <script type="text/javascript">
            document.getElementById("payuForm").submit();
        </script>
   
    <?php }

 ?>

