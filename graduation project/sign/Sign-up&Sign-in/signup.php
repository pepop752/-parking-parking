<?php
require_once "config.php";

    //لتنظيف البيانات
  
    //الاسم
    $pattern = "/^[a-zA-Z ,.'-]+$/";
    //رقم الهاتف
    $pattern3 = "/^[0-9]{11}$/";
    //الرقم القومى
    $pattern4 = "/^[0-9]{14}$/";

    $fname = $lname = $email = $Password =$Confirm = "";
    $Errfname =  $Errlname =$Erremail=$Errpassword=$Errconfirm="";



  
    if(isset($_POST['SignUp']))
    {

        $sql="SELECT * FROM sign WHERE email='". $_POST["email"] ."';";
        $result = $conn->query($sql);

        // (,.-)التحقق من ان الاسم يحتوي فقط على أحرف و العلامات 
        if (preg_match($pattern, $_POST["fname"]))
        {
            //الحصول علي الاسم من الفورم وتنظيفه من اى زيادات
            $fname = test_input($_POST["fname"]);
        }else
        {
            $Errfname =  "مسموح فقط بالأحرف والمسافات البيضاء *";
        }

        if (preg_match($pattern, $_POST["lname"]))
        {
            //الحصول علي الاسم من الفورم وتنظيفه من اى زيادات
            $lname = test_input($_POST["lname"]);
        }else
        {
            $Errlname =  "مسموح فقط بالأحرف والمسافات البيضاء *";
        }
        

        if (($result->num_rows > 0) )
        {
            $Erremail = "هذا البريد مسجل بالفعل*";
            echo "<script>alert('هذا البريد مسجل بالفعل');</script>";
        }else
        {
            if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
            {
                //الحصول علي البريد الالكترونى من الفورم وتنظيفة من اى زيادات
                $email = test_input($_POST["email"]);
            }else
            {
                $Erremail = "تنسيق البريد الإلكتروني غير صالح *";
            }
        }
    

        $password = $_POST["password"];
        $confirm = $_POST["confirm"];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        if($password!=$confirm)
        {
            $Errpassword="كلمة المرور غير متطابقة";
        }





        $query= mysqli_query($conn,"Insert into sign(fname,lname , email , password , confirm ) Values ('$fname','$lname','$email','$password','$confirm')");
        if($query){
            echo "<script>alert('data is inserted successfully');</script>";
        }
        else{
            echo "<script>alert('there is an error');</script>";

        }
        
    
}
?>











