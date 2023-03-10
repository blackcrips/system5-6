<?php 
    include './header.php';
?>
<link rel="stylesheet" href="./css/homePage.css" class="rel">
<link rel="stylesheet" href="./css/overlay.css" class="rel">
    <div class="overlay-content" id="overlay-content">
        <div class="container-cancel">   
            <span class="material-symbols-outlined cancel-button" id="cancel-button">close</span>
        </div>
        <div class="overlay_details" id="overlay-details">
        </div>
    </div>
    
    <div class="overlay" id="overlay"></div>
    <div class="home_listInfo">
        <table class="listInfo__table display" id="listInfo-table">
            <thead>
                <tr>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Contact No</th>
                    <th>Alternate No</th>
                    <th>Address</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="listInfo__tableBody">
                
            </tbody>
        </table>
    </div>
    <script src="./js/homePage.js" defer></script>
    <script src="./js/staticFunction.js" defer></script>
<?php 
    include './footer.php';
?>
