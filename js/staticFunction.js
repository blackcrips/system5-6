class StaticFunctions
{
    constructor(firstParam,secondParam,thirdParam,fourthParm,fifthParam,sixthParam) {
        this.firstParam = firstParam;
        this.secondParam = secondParam;
        this.thirdParam = thirdParam;
        this.fourthParm = fourthParm;
        this.fifthParam = fifthParam;
        this.sixthParam = sixthParam;
    }


    // start of JSX


    // End of JSX

    addEditValidation()
    {
        let arrayCountCheck = [];
        $('[data-editDetails]').each(function(){
            if($(this).val() == ''){
                $(this).css('border', '1px solid red');
            } else {
                $(this).css('border', '1px solid black');
                arrayCountCheck.push(1);
            }
        });

        return arrayCountCheck;
    }

    validateData()
    {
        $.ajax(
            {
                url: './includes/addEditValidate.inc.php',
                method: "POST",
                data: {'request-data': 'validate-data'},
                success: function(data){
                    // sample callback is true;
                    let sampleData = true;
                    if(!sampleData){
                        console.log('Error');
                    } else {
                        
                    }
                    
                }
            } 
        );
    }

    removeClasses()
    {
        let overlayContent = $('#overlay-content');

        $('#overlay').removeClass('active');
        overlayContent.removeClass('active');
        $('#body').css('overflow','scroll');
        overlayContent.children('#overlay-details').children().remove();
    }

    createOverlay()
    {
        let overlay = $('#overlay');
        let overlayContent = $('#overlay-content');

            overlay.addClass('active');
            overlayContent.addClass('active');
            $('#body').css('overflow','hidden');


            let sampleThis = new StaticFunctions();

            $('#cancel-button').click(function(){
                sampleThis.removeClasses();
            });

            $('#overlay').click(function(){
                sampleThis.removeClasses();
            });
    }

    hey()
    {
        if(!confirm('Save changes?')){
            return;
        } else {
            $('#addEditDetailsForm').append(`
                <button type='submit' id='submit' name='addEditSubmit'><button>
            `);

            $('#submit').click();
        }
    }

    createOverlayContent()
    {
        let contentOverlay = `<div class="contentOverlay">
                                    <div class="attachments">
                                        <div class='cont_span1'>
                                            <span id="span1" data-attachment>Attachment 1</span>
                                        </div>
                                        <div class='cont_span2'>
                                            <span id="span2" data-attachment>Attachment 2</span>
                                        </div>
                                        <div class='cont_span3'>
                                            <span id="span3" data-attachment>Attachment 3</span>
                                        </div>
                                        <p>Click attachment button to save the requirements. Max size 10mb</p>
                                    </div>
                                    <div class="repayment_date">

                                    </div>
                                    <div class='total_repayment'>
                                        <label for='total_payment'> Total payment: </label>
                                        <input type='text' disabled id='total_payment'>
                                    </div>
                                    <div class="container_remarks">
                                        <label for="remarks">Remarks: </label>
                                        <textarea name="remarks" id="remarks" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="repayment_button">
                                        <button type="button" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" id='overlay-cancel'>Cancel</button>
                                    </div>
                                </div>`;

            $('#overlay-details').append(contentOverlay);
            $('#remarks').focus();

            let sampleThis = new StaticFunctions();

            $('#overlay-cancel').click(function(){
                sampleThis.removeClasses();
            });

            sampleThis.attachments();
    }

    attachments()
    {
        $('[data-attachment]').click(function(){
            let thisId = $(this).attr('id').substr(-1);
            

            let lock = false
            let sampleThis = new StaticFunctions();

            return new Promise((resolve, reject) => {
                // check if input is already available
                if($('#attachment' + thisId).length > 0){
                    $('#attachment' + thisId).remove();
                }

                // create input file
                const el = document.createElement('input')
                el.id = 'attachment' + thisId;
                el.name = 'attachment' + thisId;
                el.style.display = 'none';
                el.setAttribute('type', 'file')
                $('.attachments').append(el)
        
                el.addEventListener('change', () => {
                    lock = true
                    const file = el.files[0]
                    
                    resolve(file)
                    $(this).css('color','#000');
                    sampleThis.validateAttachment(el.files[0].type,$(this));
                }, { once: true })
                
                // file blur
                window.addEventListener('focus', () => {
                    setTimeout(() => {
                        if (!lock) {
                            reject(new Error('onblur'))
                            // remove dom
                            $('#attachment' + thisId).remove();
                            $('.cont_span' + thisId).children().remove("a")
                        }
                    }, 300)
                }, { once: true })
        
                // open file select box
                el.click()
            })
            
        });
    }

    validateAttachment(attachmentType,attachmentButton)
    {
        let allowedType = ['image/png','image/jpg','image/jpeg','application/pdf'];

        if ($.inArray(attachmentType, allowedType) < 0) {
            alert('Please attach a valid image or pdf file');
            attachmentButton.css('color','#737373');
            return;
        }
    }

    validateDueDates()
    {
        let borrowDate = $('#borrowed_date').val();
        $.ajax(
            {
                url: "./includes/checkDueDates.inc.php",
                method: "POST",
                data:
                {
                    "borrowed-amount": $('#borrowed_amount').val(),
                    "borrowed-date": borrowDate,
                    "type-of-repayment": $('#type_of_repayment').val(),
                    "interest-rate": $('#interest_rate').val(),
                },
                success: function(data){
                    let parseData = JSON.parse(data);
                    let sampleThis = new StaticFunctions();
                    
                    sampleThis.getDueDates(borrowDate,parseData['repayment_count'],parseData['repayment_days_count'],parseData);
                    
                    // showing total repayment (borrowed amount * interest rate) + borrowed amount
                    $('#total_payment').val(parseData['total_repayment']);
                }
            }
        );
    }

    getDueDates(dueDate,repaymentCount,daysCount,parseData)
    {
        let m = moment(dueDate);
        

        for(let i = 1; i <= repaymentCount; i++){
            let repaymentDates = `<div class="repayment_${i}">
                                    <label for="repayment_${i}">Repayment ${i}: </label>
                                    <input type="text" disabled id="repayment_${i}" value='${parseData['repayment_per_due'].toFixed(2)}'>
                                    <label for="due${i}" class='dueDate'>Due ${i}: </label>
                                    <input type="text" disabled id="due${i}" value='${m.add(daysCount,'days').format('LL')}'>
                                </div>`;
                        $('.repayment_date').append(repaymentDates);
                    }
    }

    getSingleDetails(id)
    {
        $.ajax(
            {
                url: './includes/getSingleDetails.inc.php',
                method: "POST",
                data: 
                {
                    'request_data': id
                },
                success: function(data) {
                    clientDetails = JSON.parse(data);

                    let sampleThis = new StaticFunctions();
                    sampleThis.installmentOverlayContent(clientDetails);
                }
            }
        );
    }

    installmentOverlayContent(clientDetails)
    {
        let overlayContent = `<div class="contentOverlay">
                                <h1>INSTALLMENT</h1>
                                <form action='./includes/submitInstallment.inc.php' method='POST' id='form-installment'>
                                    <div class="installment_details">
                                        <label for="installment_name">Client name: </label>
                                        <input type="text" disabled id="installment_name" name="installment_name" value="${clientDetails.firstname} ${clientDetails.middlename} ${clientDetails.lastname}">
                                        <input type="text" hidden id="id" name='id' value='${clientDetails.id}'>
                                        <input type="text" hidden id="transId" name='transId' value='${clientDetails.transaction_id}'>
                                    </div>
                                    <div class="installment_details">
                                        <label for="payment_date">Payment date: </label>
                                        <input type="date" id="payment_date" name="payment_date" data-installmentFill>
                                    </div>
                                    <div class="installment_details">
                                        <label for="amount">Amount: </label>
                                        <input type="text" id="amount" name="amount" data-installmentFill>
                                    </div>
                                    <div class="installment_details">
                                        <label for="remarks">Remarks: </label>
                                        <textarea name="remarks" id="remarks" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="installment_buttons">
                                        <button type='submit' class='btn btn-primary' id='installment-submit'>Submit</button>
                                        <button type='button' class='btn btn-danger' id='installment-cancel'>Cancel</button>
                                    </div>
                                </form>
                            </div>`;

                            if($('#overlay-details').children().length > 0){
                                $('#overlay-details').children().remove();
                                $('#overlay-details').append(overlayContent);
                            } else {
                                $('#overlay-details').append(overlayContent);
                                $('#remarks').focus();
                            }

                            let sampleThis = new StaticFunctions();
                            $('#installment-cancel').click(() => {
                                sampleThis.removeClasses();
                            });

                            $('#installment-submit').click((e) => {
                                e.preventDefault();
                                sampleThis.submitInstallment();
                            });

    }

    submitInstallment()
    {
        let installmentFill = $('[data-installmentFill]');
        let numCount = 0;

        $.each(installmentFill,(index,item) => {
            if($(item).val() == ''){
                $(item).css('border','1px solid red');
            } else {
                $(item).css('border','1px solid #ccc');

                numCount ++;
            }
        })

        if(numCount == 2){
            $('#form-installment').submit();
        }
    }








    createAttachmentView()
    {
        alert('hey')
    }

} // end of class