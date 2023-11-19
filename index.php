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

    $sql = "SELECT * FROM categories ";
    $result = $conn->query($sql);

    

    if ($result) {
        // Fetch the category name
            $row = $result->fetch_assoc();
            $name = $row['category_name'];
            $category_id = $row['category_id'];
        }
        $sql2 = "SELECT * FROM threads";
        $result2 = $conn->query($sql2);
        $noResult2= true;
	include 'partials/_header.php';

	echo'    <div class="flex bg-gray-300 h-[88vh] w-[100vw]  items-center overflow-hidden p-4 px-12">';


	include 'partials/_left.php';
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "wonderweb";

$conn = new mysqli($servername, $username, $password, $dbname);

    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $th_title = $_POST['problem_title'];
        $th_desc= $_POST['description'];
        $th_cat_id = $_POST['category'];

        $th_title = str_replace("<","&lt;", "$th_title");
        $th_title = str_replace(">","&gt;", "$th_title");

        $th_desc = str_replace("<","&lt;", "$th_desc");
        $th_desc = str_replace(">","&gt;", "$th_desc");

        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$th_cat_id', '".$_SESSION['userid']."', current_timestamp())";
        $result = $conn->query($sql);
        $showAlert = true;

        if($showAlert){
            echo'
                <div id="alert-3" class="w-full fixed top-20 left-0 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    Thread Inserted succesfully!!!!
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
	<div class="mx-2 flex bg-gray-300 w-9/12 h-full justify-center">
        <div class="bg-gray-300 w-full h-auto p-2 flex flex-col items-center overflow-y-scroll " >
            <div class="w-10/12 bg-gray-200 border rounded-lg h-[20vh] mt-10 p-10">
                <div class="flex w-full justify-center ">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-6">';
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true"){
                       echo' 
                       <button  data-modal-target="question-modal" data-modal-toggle="question-modal" class="w-[40vw] h-8 border-2 bg-white border-black rounded-full text-gray-400 flex justify-start p-2 items-center">What do you want to ask or share?
                        </button>';
                    }
                    else{
                        echo' 
                        <button  data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="w-[40vw] h-8 border-2 bg-white border-black rounded-full text-gray-400 flex justify-start p-2 items-center">What do you want to ask or share?
                         </button>';
                    }
                    echo'</div>
                </div>
                <div class="flex justify-evenly mt-4">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                        <div class="flex">';
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true"){
                            echo'
                            <button  data-modal-target="question-modal" data-modal-toggle="question-modal">
                            Ask
                            </button>';
                        }
                        else{
                            echo'
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                            Ask
                            </button>';
                            include 'partials/_requestlogin.php';
                        }
                        echo'</div>
                    </div>
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Answer
                    </div>
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        Post
                    </div>
                </div>
            </div>
                <div class="w-10/12 h-auto bg-gray-300 p-2 mt-4">';
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "wonderweb";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql2 = "SELECT * FROM threads";
                    $result2 = $conn->query($sql2);
                    $noResult2= true;
                        while ($row2 = $result2->fetch_assoc()) {
                            $noResult2 = false;
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
                        echo'
                    <div class="bg-gray-200 w-full h-auto p-8 mt-2">
                        <div class="bg-gray-100 w-full h-auto p-8 mt-2">
                            <div class="flex">
                                <div class="w-10 h-10"><img class="w-full h-full" src="public\user.png"/></div>
                                <div class=" ml-4 flex flex-col">
                                    <div class="text-xl text-gray-500"> '.$row5['user_name'].'</div>
                                    <div class="text-sm text-gray-500">'.$time_ago.'</div>
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

                    echo'
                    </div>
                </div>
	</div>
    ';

	echo'</div>';



echo '
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
                    <form class="space-y-6" action="'.$_SERVER['REQUEST_URI'].'" method="post">
                        <div>
                            <label for="problem" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Problem Title</label>
                            <input type="text" name="problem_title" id="problem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Write short" required>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="description" placeholder="Elaborate your problem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
						<div>
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                                ';

                                    $sql10 = "SELECT * FROM categories ";
                                    $result10 = $conn->query($sql10);

                                    
                                        // Fetch the category name
                                        while ($row10 = mysqli_fetch_assoc($result10)) {
                                            $name10 = $row10['category_name'];
                                            $id10 = $row10['category_id'];

                                            echo '<option value="' . $id10 . '">' . $name10. '</option>';
                                        }
                                   


                                  echo '  
                                                                    
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
    </div>';
    ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>