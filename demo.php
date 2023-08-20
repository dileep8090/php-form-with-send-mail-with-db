<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname ="contact";
$con =mysqli_connect($servername,$username,$password,$dbname);

if($con->error){
    //echo'Connection failed';
}
else{
    //echo"connection successfully";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//include "UserInformation.php";

//validation start
 $nameErr=$numberErr=$emailErr=$subjectErr=$msgErr="";
 $name =$number=$email=$subject=$msg = "";
 if($_SERVER["REQUEST_METHOD"]=="POST"){
//name
  if(empty($_POST['name'])){
    $nameErr ="Name is Required";
  }
  else{
    $name = input_data($_POST['name']);
      if(!preg_match("/^[a-zA-Z]*$/",$name)){
        $nameErr ="Only Alphabets allow";
      }
    
  }

//number()
if(empty($_POST['number'])){
  $numberErr = " Valid Phone Number Required";
}

else{
  $number = input_data($_POST['number']);
  if(!preg_match("/^[0-9]*$/",$number)){
    $numberErr=" Only Numeric Value is allowed";

  }
  if(strlen($number)!=10){
    $numberErr = "Mobile Number must contain 10 digit";
  }
  }

  if(empty($_POST['email'])){
    $emailErr = "email required";
  }
  else{
    $email = input_data($_POST['email']);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $emailErr ="invalid email format ";
    }
  }
//subject

if(empty($_POST['subject'])){
  $subjectErr ="subject is Required";
}
else{
  $subject = input_data($_POST['subject']);
    if(!preg_match("/^[a-zA-Z]*$/",$subject)){
      $subjectErr ="Only Alphabets allow";
    }
  
}


//message

if(empty($_POST['message'])){
  $msgErr ="message is Required";
}
else{
  $msg = input_data($_POST['message']);
    if(!preg_match("/^[a-zA-Z]*$/",$msg)){
      $msgErr ="Only Alphabets allow";
    }
  
}

}
  //function
  function input_data($data){
    $data = trim($data);
    $data =stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_POST['submit'])){

   if($nameErr== "" && $numberErr== "" && $emailErr== "" && $subjectErr== "" && $msgErr== "" ){
    
      $name =$_POST['name'];
      $number = $_POST['number'];
      $email= $_POST['email'];
      $subject = $_POST['subject'];
      $msg = $_POST['message'];
      $to = ' ';//owner mail id 
      $ip=$_SERVER['REMOTE_ADDR']; 

//mail

        
  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function


  //Load Composer's autoloader
  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = ' '; //SMTP user email
    $mail->Password = ''; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('codingcommunity.in@gmail.com', 'contect Form');
    $mail->addAddress('dileepkushwaha8090@gmail.com', 'job task'); //Add a recipient


    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Contect Form';
    $mail->Body = 'Sender Name : ' . $name . '<br>' . 'Sender Email : ' . $email . '</br>' . ' Sender Number - ' . $number . '<br>'. 'Sender subject ; '.$subject. '<br>'.'Sender message : '.$msg;
    //$mail->Body =
      $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }


//mail




      $sql = "INSERT INTO `contact_form` (name, number,email, subject, message, ip) VALUES ('$name', '$number', '$email', '$subject', '$msg' ,'$ip')";
     
      //$result=mysqli_query($con,$sql);
      if ($con->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    
    
  }


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="submit"type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" >
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Full Name</label>
                <input type="name" class="form-control" name ="name"id="exampleInpuName" aria-describedby="nameHelp">
                <spam style="color:Red;">
                <?php if(isset($nameErr)){
                echo $nameErr; }?>
                </spam>
            </div>
            <div class="mb-3">
                <label for="exampleInputNumber" class="form-label">Number</label>
                <input type="number" class="form-control" name="number" id="exampleInputNumber" aria-describedby="numberHelp">
                <spam style="color:Red;">
                <?php if(isset($numberErr)){
                echo $numberErr; }?>
                </spam>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" class="form-control" name="email"id="exampleInputEmail1" aria-describedby="emailHelp">
                <spam style="color:Red;">
                <?php if(isset($emailErr)){
                echo $emailErr; }?>
                </spam>
            </div>
            <div class="mb-3">
                <label for="exampleInputSubject" class="form-label">Subject</label>
                <input type="subject" class="form-control" name="subject"id="exampleInputSubject" aria-describedby="subjectHelp">
                <spam style="color:Red;">
                <?php if(isset($subjectErr)){
                echo $subjectErr; }?>
                </spam>
            </div>
            <div class="mb-3">
                <label for="exampleInputMessage" class="form-label">Message</label>
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                <spam style="color:Red;">
                <?php if(isset($msgErr)){
                echo $msgErr; }?>
                </spam>
            </div>
            <button type="submit" name="submit"class="btn btn-primary">Submit</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>