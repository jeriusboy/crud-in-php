<?php 
// $id = $_GET['id']; 

$servername = "localhost";
$username = "root";
$password = ""; 
$database = "test";
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . $conn -> connect_error());
}

$id = "";
$name="";
$email="";
$error_message="";
$success_msg="";

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id = $_GET['id'];
    // SHOW DATA OF USER TO BE EDITED
    if(!isset($id)){
        header("location: index.php");
        exit;
    }
    $id = $_GET['id'];

    // select user to be edited
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn -> query($sql);
    if(!$result){
        die("invalid query: " . $conn -> error);
    }
    $row = $result -> fetch_assoc();
if(empty($row)){
    // user not found
    header("location: index.php");
    exit;
}
    
    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];

}else {
    // update user
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    do{
        if(empty($name) || empty($email)){
            $error_message="Please fill in all fields";
            break;
        }

        // update user
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

        $result = $conn -> query($sql);
        if(!$result){
            die("invalid query: " . $conn -> error);
        }

        $success_msg = "User updated successfully";
        header("location: index.php");
        exit;

    }while(false);
    
   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class='bg-[#f5f5f5]'>
      <div class="flex justify-center mt-32 flex-col w-full items-center "> 
      <div class="w-1/3 bg-white shadow-lg px-10 py-10 drop-shadow-md"> 
    <h1 class="text-3xl font-bold text-cyan-700 capitalize mb-5">create user</h1>

    <?php if(!empty($error_message)){  
        echo "
        <div class='py-1 bg-red-500 text-white text-sm capitalize px-6 py-2 rounded'>
            $error_message 
        </div>
        ";
    } ?>
   
   <?php if(!empty($success_msg)){  
        echo "
        <div class='py-1 bg-green-500 text-white text-sm capitalize px-6 py-2 rounded'>
            $success_msg  $name
        </div>
        ";
    } ?>
    <form action="edit.php" method="post">
<!-- Store id of user to be edited -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Your names" class="border border-slate-400 w-full rounded p-2 mt-4">
        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" class="border border-slate-400 w-full rounded p-2 mt-4">
        <input type="submit" value="submit" class="bg-cyan-800 text-white text-base capitalize px-6 py-2 rounded mt-6">
    </form>
    </div>
    </div>
</body>
</html>