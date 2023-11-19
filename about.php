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

	echo'    <div class="flex bg-gray-300 h-[85vh] w-[100vw]  items-center overflow-hidden p-4 px-12">';


	include 'partials/_left.php';
	echo'
	<div class="mx-2 flex bg-gray-300 w-9/12 h-full">
        <div class=" bg-gray-200 w-full h-full overflow-y-scroll p-4">
        <div class="font-bold text-xl mt-4"><h1>About Wonderweb</h1></div>
        <p class="mt-4">At WonderWeb, we believe in the power of community and the magic of coding. Our journey began with a simple idea: to create a space where aspiring and seasoned coders alike can come together to learn, share, and inspire one another. We are more than just a coding forum; we are a thriving community of passionate individuals who share a common love for the art of coding.</p>
        <p>WonderWeb was born from a shared love for coding and a desire to create a space where enthusiasts, beginners, and experts could come together. Our founders envisioned a platform that transcends geographical boundaries and welcomes coders from every corner of the globe. Today, WonderWeb stands as a testament to that vision.
        </p>
        <p>At WonderWeb, we have a deep-seated belief in the transformative power of coding. We exist to make the world of programming accessible, enjoyable, and meaningful for everyone, regardless of their background or expertise. Our vision is to create an inclusive online space where curiosity and collaboration thrive.
        </p>
        <div class="font-bold text-xl mt-4"><h1>Our Commitment</h1></div>
        <p  class="mt-4">
        We are committed to maintaining a platform that fosters learning, creativity, and personal growth. We are continuously improving and evolving, with the aim of providing you with the best possible coding forum experience.
        </p>
        <ul class="mt-4">
        <l1><strong>Community:</strong> WonderWeb is a place where you can find your coding tribe. Our diverse and friendly community is ready to welcome you, answer your questions, and celebrate your successes.</li>
        <li><strong>Knowledge Sharing:</strong> Dive into discussions, share your expertise, and learn from others. Our forum is a treasure trove of knowledge, tips, and solutions for coding conundrums.</li>
        <li><strong>Learning Resources:</strong> From tutorials and guides to the latest industry trends, our resources are designed to help you stay on the cutting edge of coding.</li>
        <li><strong>Collaboration:</strong> Looking to collaborate on a project? WonderWeb is the perfect platform to find like-minded partners and bring your coding ideas to life.</li>
        <li><strong>Coding Challenges</strong> Challenge yourself with coding problems and puzzles. Test your skills, compete with others, and level up your abilities.</li>
        </ul>
        <p>
        </p>
        </div>
	</div>';

	echo'</div>';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>