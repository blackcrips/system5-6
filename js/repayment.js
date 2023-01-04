let repaymentActionKey = '';
let repaymentId = '';
let passwordStatus = 'false';
let existingRepayment = true;

$('#repayment_every').change(function(){
    $(this).css('border','1px solid black');
});

$('#repayment-cancel').click(function(){
    location.href = './';
});

$('#repayment-create').click(function(){
    validate();
    repaymentActionKey = 'add';
});

$('.edit_repayment').click(function(){
    repaymentActionKey = 'edit';
    singleRepayment($(this).val());
    repaymentId = $(this).val();
});

$('.delete_repayment').click(function(){
    repaymentActionKey = 'delete';
    repaymentId = $(this).val();

    let sampleThis = new StaticFunctions();
    let overlay = $('#overlay');
    let overlayContent = $('#overlay-content');

        if(overlayContent.children('#overlay-details').length > 0){
            overlayContent.children('#overlay-details').remove();
            createOverlayDetails();
        }

            sampleThis.createOverlay();

            overlay.click(function(){
                sampleThis.removeClasses();
            })
            
            let cancelButton = $('#cancel-button');
            
            cancelButton.click(function(){
                sampleThis.removeClasses();
            });
});

$('#repayment-edit').click(() => {
    validate();
    console.log($('[data-input]').val());
});

function singleRepayment(id)
{
    $.ajax(
        {
            url: './includes/getSingleRepayment.inc.php',
            type: "POST",
            data: 
            {
                "id": id,
                'action': repaymentActionKey
            },
            success: function(data){
                let parseData = JSON.parse(data);
                if(parseData == false){
                    alert('Try fetching data. Please contact your system administrator.');
                } else {
                    if(parseData == 'deleted') {
                        alert('Repayment successfully deleted');
                        location.reload();
                    } else {
                        $('#repayment_type').val(parseData.repayment_type);
                        $('#repayment_every').val(parseData.repayment_every);
                        $('#repayment_count').val(parseData.repayment_count);
                        $('#interest_rate').val(parseData.interest_rate);
                        $('#repayment_days_count').val(parseData.repayment_days_count);
                        
                        $('#repayment-create').hide();
                        $('#repayment-edit').show();
                    }
                }
            }
        }
    );
}


function validate()
{
    inputStatus = true;

    $('[data-input]').each(function(){
        if($(this).val() == ''){
            $(this).css('border','1px solid red');
            inputStatus = false;
        }
    });

    if(inputStatus == false){
        alert("Please enter a valid information.");
    } else {
        let sampleThis = new StaticFunctions();
        let overlay = $('#overlay');
        let overlayContent = $('#overlay-content');

        if(overlayContent.children('#overlay-details').length > 0){
            overlayContent.children('#overlay-details').remove();
            createOverlayDetails();
        }
        

            sampleThis.createOverlay();

            overlay.click(function(){
                sampleThis.removeClasses();
            })
            
            let cancelButton = $('#cancel-button');
            
            cancelButton.click(function(){
                sampleThis.removeClasses();
            });
    }
}

function onKeyupInput()
{
    $('[data-input]').keyup(function(){
        if($(this).val() != ''){
            $(this).css('border','1px solid black');
        }
    });
}


onKeyupInput();


function createOverlayDetails()
{
    let overlayDetails = `<div class="overlay_details" id="overlay-details">
                            <h1>Enter Password</h1>
                            <input type='password' id='repayment-password'>
                            <span class="material-symbols-outlined" id='repayment-view-password'>
                                visibility
                            </span>
                            <div class='overlay-submit'>
                                <button class='btn btn-primary' id='password-check'>Proceed</button>
                            </div>
                          </div>`;

    let overlayContent = $('#overlay-content');   
    overlayContent.append(overlayDetails);
    $('#repayment-password').focus();


    $('#repayment-view-password').click(function(){
        if($('#repayment-password')[0].type == 'password'){
            $('#repayment-password').attr('type','text');
        } else {
            $('#repayment-password').attr('type','password');
        }
    });

    $('#password-check').click(() => {
        checkPassword();
    });
}



function checkPassword()
{
    $.ajax(
        {
            url: './includes/repayment.inc.php',
            type: "POST",
            data: 
            {
                "repayment-action": "check",
                "password": $('#repayment-password').val()
            },
            success: function(data){
                if(JSON.parse(data) == false){
                    alert('Invalid password');
                    passwordStatus = false;
                } else {
                    passwordStatus = true;
                    repaymentAction();
                }
            }
        }
    );
}

function addEditRepayment(action,id)
{
    $.ajax(
        {
            url: './includes/repayment.inc.php',
            type: "POST",
            data: 
            {
                "repayment-action": action,
                "repayment-id": id,
                "repayment-name": $('#repayment_type').val(),
                "repayment-every": $('#repayment_every').val(),
                "repayment-count": $('#repayment_count').val(),
                "interest-rate": $('#interest_rate').val(),
                "repayment-days-count": $('#repayment_days_count').val(),
                "password": $('#repayment-password').val()
            },
            success: function(data){
                if(JSON.parse(data) == false){
                    alert('Repayment name already exist!');
                    return;
                } else {
                    location.reload();
                }
            }
        }
    );
}

function repaymentAction()
{
    let sampleThis = new StaticFunctions();

    if(passwordStatus == true){
        if(repaymentActionKey == 'add'){
            addEditRepayment('add',0);
            alert('New repayment successfully added.');
            sampleThis.removeClasses();
            $('[data-input]').each(function(){
                $(this).val('');
            });
            
        } else if(repaymentActionKey == 'edit'){
            addEditRepayment('edit',repaymentId);
            alert('Repayment update success.');
            sampleThis.removeClasses();

            $('[data-input]').each(function(){
                $(this).val('');
            });

            return;
        } else if(repaymentActionKey == 'delete'){
            singleRepayment(repaymentId);
        } else {
            return;
        }
    }
}

