
<?php 
    
    //following code brings the particular row from csv file according to selected $id.

    if(empty( !$_GET )){
        echo '<br>';
        echo '<br>';
        $id = implode($_GET);        //storing in string format.
        echo $id.'<br>';
    }
    else{
        echo "Value is empty";
    }

    $file = fopen("details.csv", "r") or exit("Unable to openfile!");
     while(!feof($file))
    {       
        $row = fgets($file);
        if(strpos($row, $id) !==false){     //strpos() used to get row whcih contain particular type of id.
            $row_arr = explode(",",$row);              //convert string to array.
            $firstName_editable = $row_arr[0];
            $lastName_editable = $row_arr[1];
            $email_editable = $row_arr[2];
            $contactNumber_editable = $row_arr[3];
            $gender_editable = $row_arr[4];
            $city_editable = $row_arr[5];
        }
    }
    fclose($file);
?>


<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script type="text/javascript" language="javascript">

    function checkform()
    {
        var f = document.forms["theform"].elements;
        var cansubmit = true;

        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0) cansubmit = false;
        }

        if (cansubmit) {
            document.getElementById('submitbutton').disabled = false;
        }
    }

</script> 
</head>

<body>

<form name="theform" action="form.php" method="post">
  <label>First Name:</label><br/>     
  <input class="alert alert-info" type="text" name="fname"  placeholder="First Name" onKeyup="checkform()" required value="<?php if(!empty($firstName_editable)){echo $firstName_editable;} ?>"><br/>

  <label>Last Name:</label><br/>     
   <input class="alert alert-info" type="text" name="lname"  placeholder="Last Name" onKeyup="checkform()" required value="<?php if(!empty($lastName_editable)){echo $lastName_editable;} ?>"><br/>
  
  <label>E-mail:</label><br/>     
  <input class="alert alert-info" type="email" name="email" placeholder="Email" onchange="checkform()" required value="<?php if(!empty($email_editable)){echo $email_editable;} ?>" ><br/>
  
  <label>Contact number:</label><br/>     
  <input class="alert alert-info" type="text" name="contactNo" placeholder="Contact Number" onKeyup="checkform()" required value="<?php if(!empty($contactNumber_editable)){echo $contactNumber_editable;} ?>"><br/>
  
  <label>Gender:</label><br/> 
  <input type="radio" name="gender" value="male" required onclick="checkform()">male
  <input type="radio" name="gender" value="female" onclick="checkform()">female
  <input type="radio" name="gender" value="other" onclick="checkform()">other
  <br/><br/>    

  <label>City:</label><br/>     
  <select class="alert alert-info" required onchange="checkform()" name="city">
    <option disabled selected value> -- select an option -- </option>
    <option value="Chandigarh">Chandigarh</option>
    <option value="Lucknow">Lucknow</option>
    <option value="Delhi">Delhi</option>
    <option value="Noida">Noida</option>
    <option value="Chennai">Chennai</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Ghaziabad">Ghaziabad</option>
  </select>
  <br/> 

<button id="submitbutton"  type="submit" value="Submit" name="submit">Save</button>
<button id="submitbutton"  type="submit" value="Submit" name="edited_submit">Save Edited</button>

<!-- //disable not working  :disabled="disabled" -->
<br>
<button type="button" onClick="location.href='editDelete.php'">View <br> Details </button>

</form>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contactNo'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];

        if(isset($firstName) || isset($lastname) || isset($email) || isset($contactNumber) || isset($gender) || isset($city)){ 
            $data = array("firstName" => $firstName,                   //storing data in an array.
                        "lastname" => $lastName,
                        "email" => $email,
                        "contactNumber" => $contactNumber,
                        "gender" => $gender,
                        "city" => $city);
            //print_r($data);

            if(strlen($contactNumber) > 10){
                echo "<script type='text/javascript'>alert('ContactNumber length is not correct');</script>";
            }
            else{
                $handle = fopen("details.csv", "a");                      
                fputcsv($handle, $data);                                   //enter data in csv
                fclose($handle);
            }
        }
    }
?>

<?php
         if( isset($_POST['edited_submit']) )
        {
         $firstName = $_POST['fname'];
         $lastName = $_POST['lname'];
         $email = $_POST['email'];
         $contactNumber = $_POST['contactNo'];
         $gender = $_POST['gender'];
         $city = $_POST['city'];

         $counter = 0;

         $i = 0;
         $newdata;
         $file = fopen("details.csv", "r") or exit("Unable to openfile!");  //open file in read mode to enter all data in newdata[][]
  
         // READ CSV and save in 2D array and changing the value according to email.
          while (($data = fgetcsv($file,",")) !== FALSE) 
         {   
          $newdata[$i][0] = $data[0];          
          $newdata[$i][1] = $data[1];    
          $newdata[$i][2] = $data[2];      
          $newdata[$i][3] = $data[3];    
          $newdata[$i][4] = $data[4];    
          $newdata[$i][5] = $data[5];    
  
          if($newdata[$i][2] == $email){    //here we putting the new values into selected row.
              $counter = $i;
              $newdata[$i][0] = $firstName;
              $newdata[$i][1] = $lastName;
              $newdata[$i][2] = $email;
              $newdata[$i][3] = $contactNumber;
              $newdata[$i][4] = $gender;
              $newdata[$i][5] = $city;
          }
  
          $i++;
         }
          fclose($file);

          $handle = fopen("details.csv", "w");       
           foreach ($newdata as $value) 
          {
            fputcsv($handle, $value);
          }                                  
          fclose($handle);
  
        }
        else
        {
         "Value is empty";
        }
        
      
?>
