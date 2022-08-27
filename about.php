<?php
$servername='localhost';
$dbname='phpcommerce';
$username='root';
$password='';
$dsn='mysql:host='.$servername.';dbname='.$dbname;
try{
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE);
    // echo "Connection established successfully";
    $email=htmlspecialchars(trim($_POST['email']));
    $username=htmlspecialchars(trim($_POST['name']));
    $number=trim($_POST['number']);
if(empty($email)||empty($username)||empty($number)){
    echo ('Please fill in all fields');
    exit();
}

if(strlen($number)<10){
    echo ('Phone number must be 10 digits');
    exit();
}
if(!filter_var($email,FILTER_SANITIZE_EMAIL)){
    echo ('Incorrect email format');
    exit();
}
if(!preg_match("/^[a-zA-Z ]*$/",$username) )
{
    echo ('Username field must consist of letters and whitespace only');
    exit();
}
else{
    try{
        
        $stmt='INSERT INTO contacts(name,email,phonenumber) VALUES(:username,:email,:phonenumber)';
        $stmt=$conn->prepare($stmt);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':phonenumber',$number);
        $stmt->execute();
        header('location:index.php#contactus');
        exit();
    }catch(PDOException $ex){
        echo "Registration failure due to ". $ex->getMessage();    }
    
}

}catch(Exception $ex){
    echo "Connection failure".$ex->getMessage();
}

?>