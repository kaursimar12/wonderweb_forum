# WonderWeb - Online Forum for Programmers and Coders

Welcome to WonderWeb, an online forum designed to foster collaboration and knowledge sharing among programmers and coders. Whether you're seeking answers to programming challenges, looking to explore new ideas, or simply want to be a part of a thriving community of like-minded individuals, CodeWave has you covered. This README provides an overview of the project and guidance on how to set it up on your local environment.

## Key Features

*User Accounts*: WonderWeb empowers users to create accounts and log in to engage with the community, ask questions, share knowledge, and be a part of the collaborative ecosystem.

*Categorized Discussions*: Discussions are systematically organized into categories, making it effortless for users to locate and participate in topics that align with their interests and expertise.

*Advanced Search Functionality*: The built-in search feature allows users to pinpoint discussions and questions by searching for specific keywords. This feature ensures quick access to the information you need.

*Enhanced Security*: WonderWeb prioritizes your safety. It protects against cross-site scripting (XSS) attacks by meticulously converting code to HTML format before storing it in the database.

*Chronological Order*: To facilitate user navigation and enhance user experience, posts are presented in descending order, with the most recent discussions displayed first.

*User-Friendly Interface*: WonderWeb's user interface is thoughtfully designed to be minimal and user-friendly, offering an intuitive and pleasing experience for all users.

## Prerequisites

Before diving into WonderWeb, ensure you have the following prerequisites set up:

*XAMPP Server*: Make sure you have XAMPP installed and running on your local machine. This will serve as the web server environment for your CodeWave project.

## Installation

1. Begin by cloning this repository into your XAMPP web directory (typically 'htdocs') using the following command:

   shell
   git clone <repository-url> WonderWeb
   

2. Next, create a new database in your MySQL server and name it codewave.

3. Create the necessary database tables by executing the following SQL commands:

   - Users Table:

   sql
   CREATE TABLE `users` (
     `userId` int(8) NOT NULL,
     `username` varchar(30) NOT NULL,
     `userPass` varchar(255) NOT NULL,
     `timestamp` datetime NOT NULL DEFAULT current_timestamp()
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   

   - Categories Table:

   sql
   CREATE TABLE `categories` (
     `categoryId` int(11) NOT NULL,
     `categoryName` varchar(255) NOT NULL,
     `categoryDesc` varchar(255) NOT NULL,
     `created` datetime NOT NULL,
     `pictureName` varchar(255) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   

   - Threads Table:

   sql
   CREATE TABLE `threads` (
     `threadId` int(7) NOT NULL,
     `threadTitle` varchar(255) NOT NULL,
     `threadDesc` text NOT NULL,
     `threadUserId` int(7) NOT NULL,
     `threadCatId` int(7) NOT NULL,
     `timestamp` datetime NOT NULL DEFAULT current_timestamp()
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   

   - Comments Table:

   sql
   CREATE TABLE `comments` (
     `commentId` int(7) NOT NULL,
     `commentContent` varchar(255) NOT NULL,
     `threadId` int(7) NOT NULL,
     `commentUserid` int(8) NOT NULL,
     `commentTime` datetime NOT NULL DEFAULT current_timestamp()
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   

4. Please note that users must sign up and log in to participate in discussions or create new ones. Posts are sorted in reverse chronological order to facilitate user search and navigation.

## Getting Started

To begin your WonderWeb journey, access the WonderWeb website by navigating to http://localhost/WonderWeb in your web browser.

- Create an account or log in to start contributing to discussions, asking questions, and engaging with the vibrant community.

- Explore the available categories and utilize the search bar to effortlessly discover discussions that match your interests or address your queries.

## Contribution

If you wish to contribute to WonderWeb or report any issues, please consider creating a pull request or opening an issue on the GitHub repository. Your contributions and feedback are highly valued.

We hope you find WonderWeb to be a valuable resource for your programming journey. Together, let's create a thriving community of learners and problem solvers. Happy coding!



// Summary 

*WonderWeb* is an online forum tailored for programmers and coders. It's a platform where individuals can ask questions, explore categories, and find answers to common programming issues. Users can create accounts, log in, and engage in discussions. The website offers advanced search capabilities and ensures security against XSS attacks. With a user-friendly interface and organized content, CodeWave is a valuable resource for the programming community.

To get started, clone the repository, set up XAMPP, and create the required database tables. Users must log in to contribute to discussions. Posts are sorted chronologically, and the interface is designed to be intuitive.

Feel free to contribute to WonderWeb on its GitHub repository. Happy coding!
