<?php 
include_once('./includes/autoLoadClassesMain.inc.php');
$controller = new Controller();
$view = new View();
$controller->redirectForeignUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="./css/header.css" class="rel">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="./js/header.js" defer></script>
</head>
<body>
    <div class="body">
        <div class="menu-btn">
            <div class="menu-btn__burger"></div>
        </div>
        <div class="nav_bar">
            <div class="container_first">
                <div class="prof_photo">
                    <img src="./images/Profile.jpg" alt="Profile Photo">
                </div>
                <div class="container_name">
                    <span id="name">Hi! <?php echo $view->getUserData()['firstname'] . " " . $view->getUserData()['lastname']; ?></span>
                    <span id="caption">Looking nice and handsome</span>
                </div>
            </div>
            <div class="side_nav" id="side-nav">
                <ul>
                    <li><a href='./'>Home</a></li>
                    <li>
                        <a href="javascript:void(0)" class='nav_list'>Student <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        
                        <ul class='subNav'>
                            <li><a href='./studentsList.php'>Students list</a></li>
                            <li><a href='./studentsAction.php'>Students action</a></li>
                            <li><a href='#'>Student 3</a></li>
                        </ul>
                    </li>
                    <li><a href='javascript:void(0)' class='nav_list'>Sample 1 <span class="material-symbols-outlined">arrow_drop_down</span></a>
                        <ul class='subNav' >
                            <li><a href='#'>Student 1</a></li>
                            <li><a href='#'>Student 2</a></li>
                            <li><a href='#'>Student 3</a></li>
                        </ul>
                    </li>
                    <li><a href='#'>Sample 2</a>
                    </li>
                    <li>
                        <div class="logout">
                            <form action="./includes/logout.inc.php" method="post">
                                <button name="logout">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <div class="container_content" id="container-content">
            <div class="page_nav">
                <div class="company_name">
                    <h1 id="sampleH1">Company name here</h1>
                </div>
            </div>
            
    