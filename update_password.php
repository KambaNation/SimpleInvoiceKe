<?php



/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

//session

session_start();

if(!isset($_SESSION['login_user']))

{

    header("Location: index");

}

$login_session=$_SESSION['login_user'];

$user_id = $_SESSION['id'];

//db config

require 'includes/config.php';



//functions

require 'includes/functions.php';

//page name

$page = '';



$get_id = $_GET['id'];

?>



<?php







//compare to db

$sql ="SELECT * FROM sp_users WHERE id='$get_id'";

$result =$connect->query($sql);

$count = $result->num_rows;





//get names from result

$email_row=mysqli_fetch_array($result);

$email_address = $email_row['email'];

$fname = $email_row['fname'];

//randomize minimum character of 6

function randomPassword() {

    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

    $pass = array(); //remember to declare $pass as an array

    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

    for ($i = 0; $i < 6; $i++) {

        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];

    }

    return implode($pass); //turn the array into a string

}

//

$pass=randomPassword();

$from="info@kanadsystemsltd.com";

$headers = "From:" . strip_tags($from) . "\r\n";

$headers .= "Reply-To: ". strip_tags($from) . "\r\n";

//$headers = "From: Simpay Kenya <$email>";

$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=UTF-8\r\n";



$subject ="Your Password is reset";

$message ="Hello <strong>";

$message .=$fname;

$message .="</strong> <br>";

$message .="Your New password is : <strong>";

$message .=$pass;

$message .="</strong> <br> Thanks<br> <strong>CIO Team</strong>";



$password = md5($pass);



//update db with a new password

$password_update ="UPDATE sp_users SET password ='$password' WHERE id='$get_id'";

$result=$connect->query($password_update);

if($result===TRUE){

    mail($email_address,$subject,$message,$headers);

    echo "<script type='text/javascript'>alert('Password Successfully Updated & send to!.".$email_address.".');</script>";

    echo "<script>window.location='users.php'</script>";

}else{

    echo'Error in updating password';

}





//if yes send an email to $email with new password



//update user password in db md5()



//echo message check mail for your new password



?>

