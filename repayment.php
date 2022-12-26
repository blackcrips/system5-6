<?php 
    include './header.php';

?>
<link rel="stylesheet" href="./css/repayment.css" class="rel">
    <div class="overlay-content" id="overlay-content">
        <div class="container-cancel">   
            <span class="material-symbols-outlined cancel-button" id="cancel-button">close</span>
        </div>
        <div class="overlay_details" id="overlay-details">
        </div>
    </div>
    
    <div class="overlay" id="overlay"></div>
    <div class="container_repayment">
        <div class="repayment_details">
            <div class="repayment_action">
                <h2>ADD REPAYMENT TYPE</h2>
                <div class="repayment_field">
                    <label for="repayment_type">Repayment name: </label>
                    <input type="text" id="repayment_type" name="repayment_type" data-input>
                </div>
                <div class="repayment_field">
                    <label for="repayment_every">Repayment every: </label>
                    <select type="text" id="repayment_every" name="repayment_every" data-input>
                        <option selected value="">--SELECT--</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="2-weeks">2 Weeks</option>
                        <option value="monthly">Monthly (30days)</option>
                    </select>
                </div>
                <div class="repayment_field">
                    <label for="repayment_count">Repayment count: </label>
                    <input type="text" id="repayment_count" name="repayment_count" data-input>
                </div>
                <div class="repayment_field">
                    <label for="repayment_interest_rate">Interest rate: </label>
                    <input type="text" id="interest_rate" name="repayment_interest_rate" data-input>
                </div>
                <div class="repayment_buttons">
                    <button type="submit" class="btn btn-primary" id="repayment-create">Add</button>
                    <button type="button" class="btn btn-primary" id="repayment-edit">Edit</button>
                    <button type="button" class="btn btn-danger" id="repayment-cancel">Cancel</button>
                </div>
            </div>
            <div class="repayment_lists">
                <h2>EXISTING REPAYMENT</h2>         
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Every</th>
                            <th>Count</th>
                            <th>Interest rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($view->getRepaymentDetails() as $details) : ?>
                            <tr>
                                <td><?php echo $details['repayment_type'] ?></td>
                                <td><?php echo $details['repayment_every'] ?></td>
                                <td><?php echo $details['repayment_count'] ?></td>
                                <td><?php echo $details['interest_rate'] ?></td>
                                <td>
                                    <button class="btn btn-secondary edit_repayment" value="<?php echo $details['id'] ?>">Edit</button>
                                    <button class="btn btn-warning delete_repayment" value="<?php echo $details['id'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="./js/repayment.js" defer></script>
    <script src="./js/staticFunction.js" defer></script>

<?php 
    include './footer.php';
?>