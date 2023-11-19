<?php

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wonderweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT category_name, category_id FROM categories";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    echo '
        <div class="flex-col w-3/12 h-full overflow-y-scroll">
            <div class="bg-gray-100 w-[20vw] h-full">
                <h1 class="text-2xl font-bold mt-4 pt-4 ml-4 mb-4">Categories</h1>
                    <div class="w-full h-full flex-col align-center">
    ';

                        while ($row = $result->fetch_assoc()) {
                            $categoryName = $row["category_name"];
                            $categoryid = $row["category_id"];
                            echo 
                            '<div class="flex items-center w-[18vw] h-[6vh] mt-2 bg-gray-200 ml-4 hover:bg-gray-300 ">
                                <div class="h-6 w-6 "> <a href="threadlist.php?categoryid=' .$categoryid. '"><img class="rounded-full" src="public/' . $categoryName . '.png"/></a></div>
                                <div class="ml-2 text-xl"><a href="threadlist.php?categoryid=' .$categoryid. '">' . $categoryName . '</a></div>
                            </div>';
                        }
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
}
else {
    echo "No categories found in the database.";
}

$conn->close();
?>
