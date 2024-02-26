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
    <link rel="icon" type="image/x-icon" href="images/icons/logo1.png">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom style_sheets -->
    <link rel="stylesheet" href="./css/nav-bar_drawer.css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Coursela</title>
</head>

<body>
    <?php require './header.php'; ?>
    <style>

/* Adjustments for smaller screens */
@media (min-width: 769px) {
    .courses_card {
        width: calc(33.33% - 20px); /* Adjust width for larger screens */
        /* You may need to adjust the percentage based on your layout */
    }
}

/* Additional adjustments for even smaller screens */
@media (max-width: 480px) {
    .courses_card {
        width: 100%; /* Adjust width for smaller screens */
        max-width: none; /* Remove the maximum width */
    }
}
        .hero-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .courses_container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        .courses_card {
            width: 300px;
            margin: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            text-align: center;
        }

        .courses_card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #f9f9f9;
            /* Adjust the color as needed */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #333;
        }

        p {
            color: #0C090A;
        }

        .enroll a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FA2A55;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .enroll a:hover {
            background-color: #0056b3;
        }

        .courses_card a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            /* A different color for the button */
            color: #fff;
            /* White text color */
            border: none;
            border-radius: 5px;
            /* Rounded corners */
            text-decoration: none;
            /* Remove underline */
            transition: background-color 0.3s ease;
            /* Smooth transition for hover effect */
        }

        .courses_card a:hover {
            background-color: #0056b3;
            /* Change background color on hover */
        }
    </style>
    <section class="hero">
        <div class="container hero-content_container">
            <div class="hero-content">
                <h1>Coursela</h1>
                <p>একটি শিক্ষামূলক প্ল্যাটফর্ম, যেখানে আপনি বিভিন্ন প্রিমিয়াম অনলাইন কোর্স, প্রজেক্ট সোর্স কোড, হ্যাকিং
                    ম্যাটেরিয়ালস, পেইডক্র্যাক সফটওয়্যার এবং একাডেমিক ম্যাটেরিয়ালস পাবেন🔥</p>
                <?php
                if (isset($_SESSION['stu']))
                    echo "<a href='./student/studentProfile.php'>My Profile</a>";
                else
                    echo "<a id='start' href='#'>Get Started</a>";
                ?>
            </div>
        </div>
    </section>
    <section id="course_sec" class="courses">
        <div class="container">
            <h1 class="section_title">Popular Courses</h1>
            <div class="courses_container">
                <?php
                /* grouping the course_id column's data after join, 
                then counting each group after then order by desc and then choose the top 3
                */
                $sql = "SELECT course.* FROM course 
                JOIN course_enroll USING(course_id) 
                GROUP BY course_id 
                ORDER BY COUNT(course_id) DESC LIMIT 3";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc())
                        echo "<div class='courses_card'>
                            <img src='./images/course_img/{$row['course_img']}' alt='c_image'>
                            <h3>{$row['course_name']}</h3>
                            <p>{$row['course_desc']}</p>
                            <a href='./coursedetails.php?id={$row['course_id']}'>Learn More</a>
                        </div>";
                }
                ?>
            </div>
            <div class="enroll">
                <a href="./courses.php">View All Courses</a>
            </div>
        </div>
    </section>
    <section id="feed_sec" class="feedback">
        <div class="container">
            <h1 class="section_title">Student's FeedBack</h1>
            <div id="fmove" class="feedback_container">
                <?php
                $sql = "SELECT content,stu_img,stu_name,stu_occupation FROM feedback JOIN student ON feedback.stu_id=student.stu_id";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="feedback_card">
                            <p class="content">
                                <?php echo $row['content'] ?>
                            </p>
                            <img src="<?php echo "./images/stu_images/" . $row['stu_img'] ?>" alt="">
                            <p class="user_name">
                                <?php echo $row['stu_name'] ?>
                            </p>
                            <p class="user_occ">
                                <?php echo $row['stu_occupation'] ?>
                            </p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='margin:0 auto;'>No feedback yet :(</p>";
                }
                $conn->close();
                ?>
            </div>
            <div class=fsb>
                <button id="lf">&lt;</button>
                <button id="rt">&gt;</button>
            </div>
        </div>
    </section>

    <section id="footer_sec" class="All_footer">
        <div class="footer">
            <div class="stay_updated">
                <h2>Stay Updated</h2>
                <div class="social">
                    <span class="s_icons"><a href="https://www.facebook.com/courselabd"><img
                                src="./images/icons/facebook.svg" alt="Facebook"></a></span>
                    <span class="s_icons"><a href="https://t.me/courselabd"><img src="./images/icons/telegram.svg"
                                alt="Telegram"></a></span>
                    <span class="s_icons"><a href="#"><img src="./images/icons/instagram.svg"
                                alt="Instagram"></a></span>

                </div>
            </div>
            <div class="footer_links">
                <h3>About Us</h3>
                <p>একটি শিক্ষামূলক প্ল্যাটফর্ম, যেখানে আপনি বিভিন্ন প্রিমিয়াম অনলাইন কোর্স, প্রজেক্ট সোর্স কোড, হ্যাকিং
                    ম্যাটেরিয়ালস, পেইডক্র্যাক সফটওয়্যার এবং একাডেমিক ম্যাটেরিয়ালস পাবেন🔥</p>
            </div>
            <!-- <div class="footer_links">
                <h3>Category</h3>
                <a href="">Web Development</a><br>
                <a href="">Web Desiging</a><br>
                <a href="">Android App Dev</a><br>
                <a href="">iOS Development</a><br>
                <a href="">Data Analysis</a>
            </div> -->
            <div class="footer_links">
                <h3>Contact Us</h3>
                <p>
                    facebook.com/courselabd
                </p>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright <span>&copy;</span> 2024 | Designed by
                <?php
                if (isset($_SESSION['aid']))
                    echo "<a href='./admin/admin_dashboard.php'>Coursela</a>";
                else
                    echo "<a id='adm_log' href='#'>Coursela</a>";
                ?>
        </div>
    </section>

    <div id="modal">
        <div id="modal_content">
            <span id="close">&times;</span>
            <?php require './ad_modal.php' ?>
            <?php require './modal.php' ?>
        </div>
    </div>
    <script>

        var lf = document.getElementById('lf');
        var rt = document.getElementById('rt');
        var fmove = document.getElementById('fmove');
        lf.addEventListener('click', function () {

            fmove.scrollLeft += -300;
        });
        rt.addEventListener('click', function () {
            fmove.scrollLeft += 300;
        });
        //admin modal
        $('#adm_log').click(function () {
            $('#modal').show();
            $('#admin_modal').show();
        });
        //get started
        $('#start').click(function (event) {
            launch(this);
        });
        // admin login
        $('#admin_login').click(function (event) {
            event.preventDefault();
            $.ajax({
                url: "admin/auth.php",
                method: "POST",
                data: $('#admin_form').serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    $('#admin_span').text(data['details']);
                    if (data['status'] == 'success') {
                        window.location.href = './admin/admin_dashboard.php';
                    }
                }
            })
        });      
    </script>
    <script src="./js/home.js"></script>

</body>

</html>