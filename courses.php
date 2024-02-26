<?php
session_start();
require './db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="shortcut icon" href="#">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/nav-bar_drawer.css">
    <link rel="stylesheet" href="./css/home.css">
    <style>
        h1 {
            text-align: center;
            padding: 20px 0;
            color: #333; /* Colorful text */
        }
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
}

.card {
    width: 300px; /* Fixed width for the card */
    margin: 10px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: #fff; /* Add a background color if needed */
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: #f9f9f9; /* Adjust the color as needed */
}

.card img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    color: #4CAF50; /* Green text */
    margin-bottom: 10px;
}
.card-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #FA2A55;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}


/* Responsive styles */
@media (max-width: 768px) {
    .card {
        width: calc(50% - 20px);
    }
}
        #close {
            font-size: 2em;
        }

 .search-form {
    max-width:   600px;
    margin:   20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-form input[type="text"] {
    padding:   5px;
    width:   60%;
    border:   1px solid #ccc;
    border-radius:   4px;
    font-size:   14px;
    color: #333; /* Text color */
}

.search-form input[type="submit"] {
    padding:   5px   10px;
    margin-left:   10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius:   4px;
    cursor: pointer;
    font-size:   14px;
    transition: background-color  0.3s ease; /* Smooth transition for hover effect */
}

.search-form input[type="submit"]:hover {
    background-color: #0056b3;
}
    </style>
    <title>All Courses</title>
</head>

<body>
    <?php require './header.php'; ?>
    <form action="courses.php" method="get" class="search-form">
    <input type="text" name="search" placeholder="Search courses...">
    <input type="submit" value="Search">
</form>
<div class="card-container mb-5">
  
    <?php
    
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $searchQuery = $search ? "WHERE course_name LIKE '%$search%'" : "";
    $result = $conn->query("SELECT * FROM course $searchQuery");
    if ($result->num_rows >  0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>
            <img style='max-width:  300px;margin:auto' class='card-img-top' src='./images/course_img/{$row['course_img']}' alt='course_img'>
            <div class='card-body'>
                <h3 class='card-title'>{$row['course_name']}</h3>
                <p class='card-text'>{$row['course_desc']}</p>
                <p class='card-text'>{$row['course_author']}</p>
                <p class='card-text'>{$row['course_dur']}</p>
                <a style='display: block;' class='btn btn-primary' href='./coursedetails.php?id={$row['course_id']}' class='card-link'>Enroll Now</a>
            </div>
        </div>";
        }
    } else {
        echo "No courses found";
    }
    ?>
</div>


    <div id="modal">
        <div id="modal_content">
            <span id="close">&times;</span>
            <?php require './modal.php' ?>
        </div>
    </div>

    <script src="./js/home.js"></script>

</body>

</html>