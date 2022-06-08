<?php
//index.php

$error = '';
$name = '';
$email = '';
$date_of_birth = '';
$gender = '';
$country = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["date_of_birth"]))
 {
  $error .= '<p><label class="text-danger">Date of birth is required</label></p>';
 }
 else
 {
  $date_of_birth = clean_text($_POST["date_of_birth"]);
 }

if(empty($_POST["gender"]))
 {
  $error .= '<p><label class="text-danger">Gender is required</label></p>';
 }
 else
 {
  $gender = clean_text($_POST["gender"]);
 }
 
 if(empty($_POST["country"]))
 {
  $error .= '<p><label class="text-danger">Country is required</label></p>';
 }
 else
 {
  $country = clean_text($_POST["country"]);
 }
if ($error == '') {
    $file_open = fopen("userdata.csv", "a");
    $no_rows = count(file("userdata.csv"));
    if ($no_row > 1) {
        $no_rows = ($no_rows -1) +1;
    }
    $form_data = array(
            'sr_no' => $no_row,
            'name' => $name,
            'email' => $email,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'country' => $country,);
        fputcsv($file_open,$form_data);
        $error = '<label class="text-success">Data Stored</label>';
       
        $name = '';
        $email = '';
        $date_of_birth = '';
        $gender = '';
        $country = '';
    }

}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Real Programmer: User Register</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center"> User Register</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <br />
     <?php if(!empty($error)) {
         echo '<div class="alert alert-success" role="alert">'.$error.'</div>';
     }
     ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Date of Birth</label>
      <input type="text" name="date_of_birth" class="form-control" placeholder="Enter date of birth" value="<?php echo $date_of_birth; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Gender</label>
      <input type="text" name="gender" class="form-control" placeholder="Enter Gender" value="<?php echo $gender; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Country</label>
      <textarea name="country" class="form-control" placeholder="Enter Country"><?php echo $country; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>