<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
<title>WonderWeb</title>
</head>
<body >

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wonderweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT category_name FROM categories ";
    $result = $conn->query($sql);

    

    if ($result) {
        // Fetch the category name
            $row = $result->fetch_assoc();
            $name = $row['category_name'];
        }
        $sql2 = "SELECT * FROM threads";
        $result2 = $conn->query($sql2);
        $noResult2= true;
	include 'partials/_header.php';



    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $showalert1 = false;
        $showalert2 = false;
    
        if(isset($_POST["form2Submit"])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $sex = $_POST['sex'];
            $sql8 = "UPDATE users SET user_name='$fname', last_name='$lname', user_email='$email', user_gender='$sex' WHERE user_id=".$_SESSION['userid'];
            $result8 = mysqli_query($conn,$sql8);
            $showalert1 = true;
            
            if($showalert1){
                echo '
                <div id="alert-3" class="fixed top-[12vh] left-0 right-0 flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <span class="font-semibold">Success !!!</span> You have successfully edited your profile information
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
                ';
            }
        }elseif (isset($_POST["form1Submit"])) {
            $prevPass = $_POST['old_pass'];
            $newPass = $_POST['new_pass'];
    
            $sql9 = "SELECT * FROM users WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql9);
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['userid']);
            mysqli_stmt_execute($stmt);
            $result9 = mysqli_stmt_get_result($stmt);
            
            if ($row10 = mysqli_fetch_assoc($result9)) {
                if (password_verify($prevPass, $row10['user_pass'])) {
                    $hash = password_hash($newPass , PASSWORD_DEFAULT);
                    $sql10 = "UPDATE users SET user_pass='$hash' WHERE user_id=".$_SESSION['userid'];
                    $result10 = mysqli_query($conn,$sql10);
                    if($result10){
                        $showalert2 = "true";
                    }
                }
            }
            if($showalert2){
                echo '
                <div id="alert-10" class="fixed top-[12vh] left-0 right-0 flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        <span class="font-semibold">Success !!!</span> Your Password has been changed successfully.
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-10" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>';
            }else{
                echo '
                <div id="alert-11" class="fixed  w-full flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        <span class="font-semibold">Failed : </span> The previous Password doesnot match the actual password ! Try again.
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-11" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>';
            }
        }
    }

	echo'    <div class="flex bg-gray-300 h-[88vh] w-[100vw]  items-center overflow-hidden p-4 px-12">';

// left

$userid = $_SESSION['userid'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$query5 = "SELECT COUNT(*) AS threadCount FROM threads WHERE thread_user_id = $userid GROUP BY thread_user_id";
$result5 = mysqli_query($conn, $query5);

if ($result5) {
    $row5 = mysqli_fetch_assoc($result5);

    // Now, you can access the count value
    $threadCount = isset($row5['threadCount']) ? $row5['threadCount'] : 0;

    // Use $threadCount as needed in your code
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

$query6 = "SELECT COUNT(*) AS TotalComments FROM comments WHERE comment_by = $userid GROUP BY comment_by";
$result6 = mysqli_query($conn, $query6);

if ($result6) {
    $row6 = mysqli_fetch_assoc($result6);

    // Now, you can access the count value
    $totalComments = isset($row6['TotalComments']) ? $row6['TotalComments'] : 0;

} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

echo '
        <div class="flex-col w-3/12 h-full overflow-y-scroll">
            <div class="bg-gray-100 w-[20vw] h-full">
                <h1 class="text-2xl font-bold mt-4 pt-4 ml-4 mb-4">User Information</h1>
                    <div class="w-full h-full flex-col align-center">
    ';


    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">First Name :</div>
    <div class="text-red-500 ml-2">'.$row['user_name'].'</div>
    </div>';

    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">Last Name :</div>
    <div class="text-red-500 ml-2">'.$row['last_name'].'</div>
    </div>';

    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">Email id :</div>
    <div class="text-red-500 ml-2">'.$row['user_email'].'</div>
    </div>';

    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">Sex :</div>
    <div class="text-red-500 ml-2">'.$row['user_gender'].'</div>
    </div>';

    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">Total Questions :</div>
    <div class="text-red-500 ml-2">'.$threadCount.'</div>
    </div>';

    echo 
    '<div class="flex justify-between px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
    <div class="h-6  ">Total Comments :</div>
    <div class="text-red-500 ml-2">'.$totalComments.'</div>
    </div>';


    echo '
    <button data-modal-target="modal1-modal" data-modal-toggle="modal1-modal" class="flex justify-between text-white px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-red-500 ml-4 hover:bg-red-600">
    Edit Information
    </button>
    ';

    echo '
    <button data-modal-target="modal2-modal" data-modal-toggle="modal2-modal" class="flex justify-between text-white px-2 rounded items-center w-[18vw] h-[6vh] mt-2 bg-red-500 ml-4 hover:bg-red-600">
    Change password
    </button>
    ';

    echo'</div>';
    echo'</div>';

    echo '
            <div class="bg-gray-100 w-[20vw] h-[20vh] mt-4 p-2">
            <ul class="flex flex-wrap">
            <li>◦About &nbsp</li>
            <li>◦Careers &nbsp</li>
            <li>◦Terms &nbsp</li>
            <li>◦Privacy &nbsp</li>
            <li>◦Acceptable Use &nbsp</li>
            <li>◦Bussiness &nbsp</li>
            <li>◦Your Ad Choice &nbsp</li>
            <li>◦Grievance Officer &nbsp</li>
            </ul>
            </div>
        </div>
    ';


// modals
echo '
<div id="modal2-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in to our platform
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal2-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/WonderWeb/_profile.php" method="POST"">
                    <div>
                        <label for="old_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old Password</label>
                        <input type="password" name="old_pass" id="old_pass"  placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                    </div>
                    <div>
                        <label for="new_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="new_pass" id="new_pass" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <button type="submit" name="form1Submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                </form>
            </div>
        </div>
    </div>
</div> 
';

echo '

<div id="modal1-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in to our platform
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal1-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/WonderWeb/_profile.php" method="POST" >
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="first_name" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="'.$row['user_name'].'" required>
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  value="'.$row['last_name'].'" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="'.$row['user_email'].'" required>
                    </div>
                    <div>
                        <label for="sex" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="text" name="sex" id="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="'.$row['user_gender'].'" required>
                    </div>

                    <button type="submit" name="form2Submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change Information</button>
                </form>
            </div>
        </div>
    </div>
</div> 
';
    

	echo'
	<div class="mx-2 flex bg-gray-300 w-9/12 h-full justify-center">
        <div class="bg-gray-300 w-full h-auto p-2 flex flex-col items-center overflow-y-scroll " >
                <div class="w-10/12 h-auto bg-gray-300 p-2 mt-4">';
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "wonderweb";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $sql2 = "SELECT * FROM `threads` WHERE thread_user_id = $userid ";
                    $result2 = $conn->query($sql2);
                    $noResult2= true;
                        while ($row2 = $result2->fetch_assoc()) {
                            $noResult2 = false;
                            $title = $row2['thread_title'];
                            $desc = $row2['thread_desc'];
                            $threadid = $row2['thread_id'];
                            $thread_user_id = $row2['thread_user_id'];
                            $sql5 = "SELECT * FROM `users` WHERE user_id = '$thread_user_id'";
                            $result5 = mysqli_query($conn, $sql5);
                            $row5 = mysqli_fetch_assoc($result5);
                            $row5['user_email'];
                            $row5['user_name'];
                        echo'
                    <div class="bg-gray-200 w-full h-auto p-8 mt-2">
                        <div class="bg-gray-100 w-full h-auto p-8 mt-2">
                            <div class="flex">
                                <div class="w-10 h-10"><img class="w-full h-full" src="public\user.png"/></div>
                                <div class=" ml-4 flex flex-col">
                                    <div class="text-xl text-gray-500"> '.$row5['user_name'].'</div>
                                    <div class="text-sm text-gray-500">4 mins ago</div>
                                </div>
                            </div>
                            <div class="text-xl font-bold mt-4"><a href="thread.php?threadid=' .$threadid .'">'. $title.'</a></div>
                            <div class="text-lg mt-2"> <a href="thread.php?threadid=' .$threadid .'">'. $desc.'</div>
                            <div class=" mt-2">    
                                <a href="thread.php?threadid=' .$threadid .'" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    Read More
                                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-100 w-full h- mt-2 p-2">
                        <ol class="relative border-l border-gray-200 dark:border-gray-700">';
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "wonderweb";

                        $conn = new mysqli($servername, $username, $password, $dbname);
                        $sql3 = "SELECT * FROM comments WHERE thread_id=$threadid";
                        $result3 = $conn->query($sql3);
                        $noResult3= true;
                        $iteration=0;
                            while ($row3 = $result3->fetch_assoc()) {
                                $noResult3 = false;
                                $iteration++;
                                $commentid = $row3['comment_id'];
                                $content = $row3['comment_content'];
                                $comment_by = $row3['comment_by'];
                                $sql5 = "SELECT * FROM `users` WHERE user_id = '$comment_by'";
                                $result5 = mysqli_query($conn, $sql5);
                                $row5 = mysqli_fetch_assoc($result5);
                                $row5['user_email'];
                                $row5['user_name'];
                                
                                // if($iteration > 2){
                                    
                                    
                        echo'
                        <li class="mb-2 ml-2">
                            <div class="w-11/12 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <div class="items-center justify-between mb-3 sm:flex">
                                    <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">2 hours ago</time>
                                    <div class="flex">
                                    <div class="w-10 h-10"><img class="w-full h-full" src="public\user.png"/></div>
                                    <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300 ml-4">' . $row5['user_name'] . ' commented on <span class="font-semibold text-gray-900 dark:text-white hover:underline">' . $title . '</span></div>
                                    </div>
                                </div>
                                <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">"' .$content. '"</div>
                            </div>
                        </li>';
                            // }
                        }
                        if($noResult3){
                            echo'
                        <li class="mb-2 ml-2">
                            <div class="w-11/12 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <div class="items-center justify-between mb-3 sm:flex">
                                    <div class="flex">
                                    <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300 ml-4">No comments yet</div>
                                    </div>
                                </div>
                            </div>
                        </li>';
                        }
                        echo'
                        </ol>
                        </div>
                    </div>';
                        }
                        if($noResult2){
                            echo'
                            <div class="w- bg-gray-200 border rounded-lg h-auto mt-10 p-10">
                                <div class="searchReults flex flex-col items-center">
                                <h1 class="text-3xl font-bold text-red-500 text-5xl "> Sorry!!</h1>
                                <img src="public\no-result.gif" alt="No Result Found" class="mx-auto mb-6">
                                <h1 class="text-3xl font-bold"> No Results for   <span class="text-red-500 text-5xl font-bold">" ' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . ' "</span></h1>
                                </div>
                            </div>';
                        }

                    echo'
                    </div>
                </div>
	</div>
    ';

	echo'</div>';


?>
   <!-- Main modal -->
    <div id="question-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="question-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Ask Question</h3>
                    <form class="space-y-6" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div>
                            <label for="problem" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Problem Title</label>
                            <input type="text" name="problem_title" id="problem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Write short" required>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="description" placeholder="Elaborate your problem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
						<div>
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <select name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                                <option value="option1">Option 1</option>
                                </select>
                        </div>
							<div class="flex justify-between">
							    <div class="flex items-start">
                        </div>
                        <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>