<?php 
    include './header.php';
?>
<link rel="stylesheet" href="./css/addEditDetails.css" class="rel">
    <div class="overlay-content" id="overlay-content">
        <div class="container-cancel">   
            <span class="material-symbols-outlined cancel-button" id="cancel-button">close</span>
        </div>
        <div class="overlay_details" id="overlay-details">
        </div>
    </div>
    
    <div class="overlay" id="overlay"></div>
    <div class="container_addEditDetails">
        <form action="./includes/addBorrower.inc.php" method="POST" id="addEditDetailsForm">
            <div class="alert-container">
            
            </div>
            <div class="personal_details">
                <h2>PERSONAL DETAILS</h3>
                
                <div class="pdetails__content">
                    <span>Name: </span>
                    <div class="pdetails__row1">
                        <input type="text" id="firstname" name="firstname" data-addEditDetails>
                        <label for="firstname">Firstname</label>
                    </div>
                    <div class="pdetails__row1">
                        <input type="text" id="middlename" name="middlename" data-addEditDetails>
                        <label for="middlename">Middlename</label>
                    </div>
                    <div class="pdetails__row1">
                        <input type="text" id="lastname" name="lastname" data-addEditDetails>
                        <label for="lastname">Lastname</label>
                    </div>
                </div>
                <div class="pdetails__content">
                    <label for="gender">Gender: </label>
                    <input type="text" id="gender" name="gender" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="date">Date: </label>
                    <input type="date" id="date" name="date" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="contact_no">Contact number: </label>
                    <input type="text" id="contact_no" name="contact_no" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="alt_cont_no">Alternate contact no.: </label>
                    <input type="text" id="alt_cont_no" name="alt_cont_no" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="social_media">Social media account: </label>
                    <input type="text" id="social_media" name="social_media" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="address">Address: </label>
                    <input type="text" id="address" name="address" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="marital_status">Marital status: </label>
                    <input type="text" id="marital_status" name="marital_status" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="spouse_name">Spouse name: </label>
                    <input type="text" id="spouse_name" name="spouse_name" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="spouse_work">Spouse work: </label>
                    <input type="text" id="spouse_work" name="spouse_work" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="spouse_cont_no">Spouse contact no.: </label>
                    <input type="text" id="spouse_cont_no" name="spouse_cont_no" data-addEditDetails>
                </div>
                
            </div>

            <div class="personal_details">
                <h2>JOB INFORMATION</h3>
                <div class="pdetails__content">
                    <label for="comapany_name">Company name: </label>
                    <input type="text" id="comapany_name" name="comapany_name" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="job_position">Position: </label>
                    <input type="text" id="job_position" name="job_position" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="company_address">Company address: </label>
                    <input type="text" id="company_address" name="company_address" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="company_cont_no">Company contact no.: </label>
                    <input type="text" id="company_cont_no" name="company_cont_no" data-addEditDetails>
                </div>
            </div>
            <div class="personal_details">
                <h2>REFERENCES</h3>
                <div class="pdetails__content">
                    <label for="reference_name_1">Reference name: </label>
                    <input type="text" id="reference_name_1" name="reference_name_1" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="reference_cont_no1">Reference no.: </label>
                    <input type="text" id="reference_cont_no1" name="reference_cont_no1" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="reference_name_2">Reference name: </label>
                    <input type="text" id="reference_name_2" name="reference_name_2" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="reference_cont_no3">Reference no.: </label>
                    <input type="text" id="reference_cont_no3" name="reference_cont_no3" data-addEditDetails>
                </div>
            </div>

            <div class="personal_details">
                <h2>LOAN DETAILS</h3>
                <div class="pdetails__content">
                    <label for="borrowed_amount">Borrowed amount: </label>
                    <input type="text" id="borrowed_amount" name="borrowed_amount" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="borrowed_date">Borrowed date: </label>
                    <input type="text" id="borrowed_date" name="borrowed_date" data-addEditDetails>
                </div>
                <div class="pdetails__content">
                    <label for="type_of_repayment">Type of repayment: </label>
                    <select id="type_of_repayment" name="type_of_repayment" data-addEditDetails>
                        <option selected>Select repayment type</option>
                    </select>
                </div>
                <div class="pdetails__content">
                    <label for="interest_rate">Interest rate: </label>
                    <input type="text" id="interest_rate" name="interest_rate" data-addEditDetails>
                </div>
            </div>

            <div class="personal_details">
                <div class="buttons">
                    <button type="button" class="btn btn-primary" id="addEditSubmit" name="submit">Next</button>
                    <button type="button" class="btn btn-danger" id="addEditCancel">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/addEditDetails.js" defer></script>
    <script src="./js/staticFunction.js" defer></script>
<?php 
    include './footer.php';
?>