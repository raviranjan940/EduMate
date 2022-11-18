<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number']; 
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg']; 
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'message sent already!';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- contact section starts  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.png" alt="">
      </div>

      <form action="" method="post">
         <h3>Get in touch</h3>
         <input type="text" placeholder="enter your name" required maxlength="100" name="name" class="box">
         <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
         <input type="number" min="0" max="9999999999" placeholder="enter your number" required maxlength="10" name="number" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" required cols="30" rows="10" maxlength="1000"></textarea>
         <input type="submit" value="send message" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Phone Number</h3>
         <a href="tel:1234567890">+91 620-474-3523</a>
         <a href="tel:1112223333">+91 747-941-0130</a>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>Email Address</h3>
         <a href="mailto:contact@edumate.com">contact@edumate.com</a>
         <a href="mailto:feedback@edumate.com">feedback@edumate.com</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Office Address</h3>
         <a href="https://www.google.co.in/maps/dir/Railway+Overbridge+Chandigarh+Station,+Industrial+Area+Phase+I,+Chandigarh,+160002/Chandigarh+University,+National+Highway+95,+Chandigarh,+Punjab+140413/@30.7198511,76.617615,24483m/data=!3m1!1e3!4m14!4m13!1m5!1m1!1s0x390fec947e343a03:0x630965525c92f360!2m2!1d76.7974615!2d30.6962876!1m5!1m1!1s0x390ffb140bd63e07:0x68591e334d17a988!2m2!1d76.574615!2d30.7688207!5i1?hl=en">Gharuan, Near Chandigarh University, Mohali, India - 140413</a>
      </div>


   </div>

</section>

<!-- contact section ends -->











<?php include 'components/footer.php'; ?>  

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>