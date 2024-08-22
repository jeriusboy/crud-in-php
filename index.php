
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center  flex-col pt-20">
    <div class="w-1/2 bg-white shadow-lg px-10 py-10 drop-shadow-md">
   <h1 class="text-3xl font-bold text-cyan-800">CRUD in php</h1>
   <div class="py-7">
   <a class="bg-cyan-800 text-white text-base capitalize px-8 py-2 rounded " href="/php_project/create.php">create</a>
   </div>
   <table class="w-full table-auto border-collapse border border-slate-400">
    <thead>
        <tr class="py-4">
            <th class="border border-slate-300 py-3 capitalize ">id</th>
            <th class="border border-slate-300 py-3 capitalize">name</th>
            <th class="border border-slate-300 py-3 capitalize">email</th>
            <th class="border border-slate-300 py-3 capitalize">action</th>
        </tr>
    </thead>
    <tbody> 
        <?php

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $database = "test";
        $conn = mysqli_connect($servername, $username, $password, $database);

        if(!$conn){
            die("Connection failed: " . $conn -> connect_error());
        }

        $sql = "SELECT * FROM users";
        $result = $conn -> query($sql);
        if(!$result){
            die("invalid query: " . $conn -> error);
        }

        while($row = $result -> fetch_assoc()){
            echo "
            <tr>
            <td class='border border-slate-300 py-2  text-center'>$row[id]</td>
            <td class='border border-slate-300 py-2 capitalize pl-4'>$row[name]</td>
            <td class='border border-slate-300 py-2 capitalize pl-4'>$row[email]</td>
            <td class='border border-slate-300 py-2  flex gap-4 justify-center'>
                <a class='bg-cyan-800 text-white text-base capitalize px-6 py-1 rounded ' href='/php_project/edit.php?id=$row[id]'>edit</a>
                <a class='bg-red-800 text-white text-base capitalize px-6 py-1 rounded ' href='/php_project/delete.php?id=$row[id]'>delete</a>
            </td>

        </tr>
            ";
        }


        ?>
       
    </tbody>
   </table>
   </div>
   </div>
</body>
</html>