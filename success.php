<?php 

    $title = 'Index';
    require_once 'includes/header.php'; 
    require_once 'db/conn.php';
    require_once 'sendemail.php';


    if(isset($_POST['submit'])){
        //extract values from the $_POST array
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];
        $specialty = $_POST['specialty'];
        
        //Call function to insert and track if successful or not
        $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $email, $contact, $specialty);
        $specialtyName = $crud->getSpecialtyById($specialty);
        
        if($isSuccess){
            SendEmail::SendMail($email,'Welcome to IT Conference', 'You have successfully registered for this year\'s IT Conference. We have a beautiful line up for you.');
           include 'includes/successmessage.php';
        }
        else{
            include 'includes/errormessage.php';
        
        }
    }
    
?>
<!--
    <h1 class="text-center text-success">You Have Been Successfully Registered!</h1>
 get method
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php //echo $_GET['firstname'] .' '. $_GET['lastname']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $_GET['specialty']; ?></h6>
            <p class="card-text">
            Date Of Birth: <?php //echo $_GET['dob']; ?>
            </p>

            <p class="card-text">
            Email Address: <?php //echo $_GET['email']; ?>
            </p>

            <p class="card-text">
            Contact Number: <?php //echo $_GET['phone']; ?>
            </p>

        </div>
    </div>
 -->
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $_POST['firstname'] .' '. $_POST['lastname']; ?></h5>
            
            <h6 class="card-subtitle mb-2 text-muted">
            <?php echo $specialtyName['name']; ?></h6>
            
            <p class="card-text">
            Date Of Birth: <?php echo $_POST['dob']; ?>
            </p>

            <p class="card-text">
            Email Address: <?php echo $_POST['email']; ?>
            </p>

            <p class="card-text">
            Contact Number: <?php echo $_POST['phone']; ?>
            </p>

        </div>
    </div>
<!--
    <?php 
        echo $_POST['firstname']; 
        echo $_POST['lastname'];
        echo $_POST['dob'];
        echo $_POST['specialty'];
        echo $_POST['email'];
        echo $_POST['phone'];
    ?>
-->


<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<br/>


    <?php require_once 'includes/footer.php'; ?> 