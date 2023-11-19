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
    
	include 'partials/_header.php';
    echo'<div class="flex bg-gray-300 h-[85vh] w-[100vw]  items-center overflow-hidden p-4 px-12">';
	include 'partials/_left.php';
        // Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wonderweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	echo'
    <div class="flex flex-col items-center bg-gray-300 w-9/12 h-full items-center overflow-y-scroll p-4">
        <div class="w-full  bg-gray-300  flex flex-col  items-center justify-center p-8">
            <div class="w-10/12 h-auto bg-gray-300 p-2 mt-4">';
            $threadid= $_GET['threadid'];
            $sql2 = "SELECT * FROM threads WHERE thread_id=$threadid";
            $result2 = $conn->query($sql2);
        
                while ($row2 = $result2->fetch_assoc()) {
                    $title = $row2['thread_title'];
                    $desc = $row2['thread_desc'];
                    $threadid = $row2['thread_id'];
                    $qtime = $row2['timestamp'];
                    $thread_user_id = $row2['thread_user_id'];
                    $sql5 = "SELECT * FROM `users` WHERE user_id = '$thread_user_id'";
                    $result5 = mysqli_query($conn, $sql5);
                    $row5 = mysqli_fetch_assoc($result5);
                    $row5['user_email'];
                    $row5['user_name'];

                    $timestamp1 = new DateTime($qtime, new DateTimeZone('Asia/Kolkata')); // Set the time zone for India
                    $current_time = new DateTime("", new DateTimeZone('Asia/Kolkata')); // Set the time zone for India

                    $interval1 = $current_time->diff($timestamp1);
                    $minutes1 = $interval1->i + ($interval1->h * 60);
                    $hours1 = $interval1->h + ($interval1->d * 24);
                    $days1 = $interval1->d;

                    if ($days1 == 0) {
                        if ($hours1 == 0) {
                            if ($minutes1 == 0) {
                                $time_ago = "Just now";
                            } elseif ($minutes1 == 1) {
                                $time_ago = "1 min ago";
                            } else {
                                $time_ago = $minutes1 . " mins ago";
                            }
                        } elseif ($hours1 == 1) {
                            $time_ago = "1 hr ago";
                        } else {
                            $time_ago = $hours1 . " hrs ago";
                        }
                    } elseif ($days1 == 1) {
                        $time_ago = "1 day ago";
                    } else {
                        $time_ago = $days1 . " days ago";
                    }

                    $showAlert = false;
                    $method = $_SERVER['REQUEST_METHOD'];
                    if($method == 'POST'){
                        $comment = $_POST['comment'];
                        $comment = str_replace("<","&lt;", "$comment");
                        $comment = str_replace(">","&gt;", "$comment");
                        $userid = $_SESSION['userid'];
                        $sql9 = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$threadid', '$userid', current_timestamp());";
                        $result9 = $conn->query($sql9);
                        $showAlert = true;
                
                        if($showAlert){
                            echo'
                                <div id="alert-3" class="w-full fixed top-20 left-0 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-400" role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ml-3 text-sm font-medium">
                                    Comment Inserted succesfully!!!!
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                                </div>';
                                        
                        }
                    }
                echo'
                <div class="bg-gray-300 w-full h- p-2 mt-2">
                    <div class="bg-gray-100 w-full h-auto p-8 mt-2">
                        <div class="flex">
                            <div class="w-10 h-10"><img class="w-full h-full" src="public\user.png"/></div>
                            <div class=" ml-4 flex flex-col">
                                <div class="text-xl text-gray-500"> '.$row5['user_name'].'</div>
                                <div class="text-sm text-gray-500">'.$time_ago.'</div>
                            </div>
                        </div>
                        <div class="text-xl font-bold mt-2"><a href="thread.php?threadid=' .$threadid .'">'. $title.'</a></div>
                        <div class="text-lg mt-2"> <a href="threadlist.php">'. $desc.'</div>
                        <div class=" mt-2">';  
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true"){
                            echo'
                            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal">
                                <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-black rounded-lg bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-500">
                                Add comment
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                </a>
                            </button>';
                        }
                        else{                                
                            echo'
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-black rounded-lg bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-500">
                            Add comment
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            </a>
                        </button>';
                        include 'partials/_requestlogin.php';

                        }
                        echo'
                        </div>
                    </div>
                    <div class="bg-gray-100 w-full h-auto mt-2 p-2">
                    <ol class="relative border-l border-gray-200 dark:border-gray-700">';
                  
                    $sql3 = "SELECT * FROM comments WHERE thread_id=$threadid";
                    $result3 = $conn->query($sql3);
                    $noResult3= true;
                        while ($row3 = $result3->fetch_assoc()) {
                            $noResult3 = false;
                            $commentid = $row3['comment_id'];
                            $content = $row3['comment_content'];
                            $comment_by = $row3['comment_by'];
                            $ctime = $row3['comment_time'];
                            $sql5 = "SELECT * FROM `users` WHERE user_id = '$comment_by'";
                            $result5 = mysqli_query($conn, $sql5);
                            $row5 = mysqli_fetch_assoc($result5);
                            $row5['user_name'];
                            $timestamp2 = new DateTime($ctime, new DateTimeZone('Asia/Kolkata')); // Set the time zone for India
                            $current_time2 = new DateTime("", new DateTimeZone('Asia/Kolkata')); // Set the time zone for India

                            $interval2 = $current_time2->diff($timestamp2);
                            $minutes2 = $interval2->i + ($interval2->h * 60);
                            $hours2 = $interval2->h + ($interval2->d * 24);
                            $days2 = $interval2->d;

                            if ($days2 == 0) {
                                if ($hours2 == 0) {
                                    if ($minutes2 == 0) {
                                        $time_ago2 = "Just now";
                                    } elseif ($minutes2 == 1) {
                                        $time_ago2 = "1 min ago";
                                    } else {
                                        $time_ago2 = $minutes2 . " mins ago";
                                    }
                                } elseif ($hours2 == 1) {
                                    $time_ago2 = "1 hr ago";
                                } else {
                                    $time_ago2 = $hours2 . " hrs ago";
                                }
                            } elseif ($days2 == 1) {
                                $time_ago2 = "1 day ago";
                            } else {
                                $time_ago2 = $days2 . " days ago";
                            }


                    echo'
                    <li class="mb-2 ml-2">
                        <div class="w-11/12 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <div class="items-center justify-between mb-3 sm:flex">
                                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">'.$time_ago2.'</time>
                                <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">'.$row5['user_name'].' commented on  <span class="font-semibold text-gray-900 dark:text-white hover:underline">' .$title. '</span></div>
                            </div>
                            <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">"' .$content. '"</div>
                        </div>
                    </li>';
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
            echo'
            </div>
        </div>
    </div>
    ';  
            

    echo'</div>';

?>
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">Your comment on:</h3>
                <form class="space-y-6" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                    <div>
                        <label for="text" class="block mb-2 text-xl font-bold text-red-500 dark:text-white"><?php echo"$title"?></label>
                        <input type="comment" name="comment" id="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter your comment here" required>
                    </div>
                    <div class="flex justify-between">
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