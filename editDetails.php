<?php 
    include './header.php';

    $view = new View();
?>
<link rel="stylesheet" href="./css/editDetails.css" class="rel">
<script src="./lib/moment/moment.min.js"></script>
    <div class="container_addEditDetails">
        <form action="./includes/addBorrower.inc.php" method="POST" id="addEditDetailsForm">
            <div class="alert-container">
            
            </div>
            <div class="personal_details">
                <h2>PERSONAL DETAILS</h3>
                <div class="pdetails__content">
                    <span>Name: </span>
                    <div class="pdetails__row1">
                        <input type="text" id="firstname" name="firstname" data-editDetails value="<?php echo $view->showDetails()['firstname']?>">
                        <label for="firstname">Firstname</label>
                    </div>
                    <div class="pdetails__row1">
                        <input type="text" id="middlename" name="middlename" data-editDetails value="<?php echo $view->showDetails()['middlename']?>">
                        <label for="middlename">Middlename</label>
                    </div>
                    <div class="pdetails__row1">
                        <input type="text" id="lastname" name="lastname" data-editDetails value="<?php echo $view->showDetails()['lastname']?>">
                        <label for="lastname">Lastname</label>
                    </div>
                </div>
                <div class="pdetails__content">
                    <label for="gender">Gender: </label>
                    <select id="gender" name="gender" data-editDetails>
                        <option selected value="<?php echo $view->showDetails()['gender']?>"><?php echo $view->showDetails()['gender']?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="pdetails__content">
                    <label for="date">Date: </label>
                    <input type="date" id="date" name="date" data-editDetails value="<?php echo $view->showDetails()['birthday']?>">
                </div>
                <div class="pdetails__content">
                    <label for="contact_no">Contact number: </label>
                    <input type="text" id="contact_no" name="contact_no" data-editDetails value="<?php echo $view->showDetails()['contact_no']?>">
                </div>
                <div class="pdetails__content">
                    <label for="alt_cont_no">Alternate contact no.: </label>
                    <input type="text" id="alt_cont_no" name="alt_cont_no" value="<?php echo $view->showDetails()['alternate_contact_no']?>">
                </div>
                <div class="pdetails__content">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" data-editDetails value="<?php echo $view->showDetails()['email']?>">
                </div>
                <div class="pdetails__content">
                    <label for="social_media">Social media account: </label>
                    <input type="text" id="social_media" name="social_media" data-editDetails value="<?php echo $view->showDetails()['social_media_account']?>">
                </div>
                <div class="pdetails__content">
                    <label for="address">Address: </label>
                    <input type="text" id="address" name="address" data-editDetails value="<?php echo $view->showDetails()['address']?>">
                </div>
                <div class="pdetails__content">
                    <label for="marital_status">Marital status: </label>
                    <input type="text" id="marital_status" name="marital_status" data-editDetails value="<?php echo $view->showDetails()['marital_status']?>">
                </div>
                <div class="pdetails__content">
                    <label for="spouse_name">Spouse name: </label>
                    <input type="text" id="spouse_name" name="spouse_name"  value="<?php echo $view->showDetails()['spouse_name']?>">
                </div>
                <div class="pdetails__content">
                    <label for="spouse_work">Spouse work: </label>
                    <input type="text" id="spouse_work" name="spouse_work" value="<?php echo $view->showDetails()['spouse_work']?>">
                </div>
                <div class="pdetails__content">
                    <label for="spouse_cont_no">Spouse contact no.: </label>
                    <input type="text" id="spouse_cont_no" name="spouse_cont_no" value="<?php echo $view->showDetails()['spouse_contact_no']?>">
                </div>
                
            </div>

            <div class="personal_details">
                <h2>JOB INFORMATION</h3>
                <div class="pdetails__content">
                    <label for="comapany_name">Company name: </label>
                    <input type="text" id="comapany_name" name="comapany_name" data-editDetails value="<?php echo $view->showDetails()['company_name']?>">
                </div>
                <div class="pdetails__content">
                    <label for="job_position">Position: </label>
                    <input type="text" id="job_position" name="job_position" value="<?php echo $view->showDetails()['job_title']?>">
                </div>
                <div class="pdetails__content">
                    <label for="company_address">Company address: </label>
                    <input type="text" id="company_address" name="company_address"  value="<?php echo $view->showDetails()['company_address']?>">
                </div>
                <div class="pdetails__content">
                    <label for="company_cont_no">Company contact no.: </label>
                    <input type="text" id="company_cont_no" name="company_cont_no" value="<?php echo $view->showDetails()['company_contact_no']?>">
                </div>
            </div>
            <div class="personal_details">
                <h2>REFERENCES</h3>
                <div class="pdetails__content">
                    <label for="reference_name_1">Reference name: </label>
                    <input type="text" id="reference_name_1" name="reference_name_1" data-editDetails value="<?php echo $view->showDetails()['ref_name_1']?>">
                </div>
                <div class="pdetails__content">
                    <label for="reference_cont_no1">Reference no.: </label>
                    <input type="text" id="reference_cont_no1" name="reference_cont_no1" data-editDetails value="<?php echo $view->showDetails()['ref_cont_1']?>">
                </div>
                <div class="pdetails__content">
                    <label for="reference_name_2">Reference name: </label>
                    <input type="text" id="reference_name_2" name="reference_name_2"  value="<?php echo $view->showDetails()['ref_name_2']?>">
                </div>
                <div class="pdetails__content">
                    <label for="reference_cont_no2">Reference no.: </label>
                    <input type="text" id="reference_cont_no2" name="reference_cont_no2" value="<?php echo $view->showDetails()['ref_cont_2']?>">
                </div>
                <div class="pdetails__content">
                    <label for="reference_name_3">Reference name: </label>
                    <input type="text" id="reference_name_3" name="reference_name_3" value="<?php echo $view->showDetails()['ref_name_3']?>">
                </div>
                <div class="pdetails__content">
                    <label for="reference_cont_no3">Reference no.: </label>
                    <input type="text" id="reference_cont_no3" name="reference_cont_no3" value="<?php echo $view->showDetails()['ref_cont_3']?>">
                </div>
            </div>

            <div class="personal_details">
                <h2>LOAN DETAILS</h3>
                <div class="pdetails__content">
                    <label for="borrowed_amount">Borrowed amount: </label>
                    <input type="text" id="borrowed_amount" name="borrowed_amount" data-editDetails value="<?php echo $view->showDetails()['borrow_amount']?>">
                </div>
                <div class="pdetails__content">
                    <label for="borrowed_date">Borrowed date: </label>
                    <input type="date" id="borrowed_date" name="borrowed_date" data-editDetails value="<?php echo $view->showDetails()['borrow_date']?>">
                </div>
                <div class="pdetails__content">
                    <label for="type_of_repayment">Type of repayment: </label>
                    <select id="type_of_repayment" name="type_of_repayment" data-editDetails>
                        <option selected value="<?php echo $view->showDetails()['repayment_type']?>"><?php echo $view->showDetails()['repayment_type']?></option>
                    </select>
                </div>
                <div class="pdetails__content">
                    <label for="interest_rate">Interest rate: </label>
                    <input type="text" id="interest_rate" name="interest_rate" data-editDetails value="<?php echo $view->showDetails()['interest_rate']?>">
                </div>
            </div>

            <div class="personal_details">
                <h2>DUE DATES</h3>
                <div class="pdetails__content">
                    <label for="borrowed_amount">Borrowed amount: </label>
                    <input type="text" id="borrowed_amount" name="borrowed_amount" data-editDetails value="<?php echo $view->showDetails()['borrow_amount']?>">
                    <input type="text" id="borrowed_amount" name="borrowed_amount" data-editDetails value="<?php echo $view->showDetails()['borrow_amount']?>">
                </div>
            </div>

            <div class="personal_details">
                <div class="buttons">
                    <?php if($view->showDetails()['status'] == 'Active') : ?>
                        <button type="button" class="btn btn-primary" id="editSubmit" name="submit">Paid</button>
                        <button type="button" class="btn btn-danger" id="editCancel">Back</button>
                    <?php elseif($view->showDetails()['status'] == 'Close') : ?>
                        <button type="button" class="btn btn-success" id="editReloan" name="submit">Reloan</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/editDetails.js" defer></script>
    <script src="./js/staticFunction.js" defer></script>
<?php 
    include './footer.php';
?>