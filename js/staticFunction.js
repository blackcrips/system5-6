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
        $('[data-addEditDetails]').each(function(){
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
                        let sampleThis = new StaticFunctions();
                            sampleThis.createOverlay();
                            sampleThis.createOverlayContent();

                            overlay.click(function(){
                                sampleThis.removeClasses();
                            })
                            
                            let cancelButton = $('#cancel-button');
                            
                            cancelButton.click(function(){
                                sampleThis.removeClasses();
                            });
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
                                        <div class="first_repayment">
                                            <label for="first_repayment">First repayment: </label>
                                            <input type="text" disabled id="first_repayment">
                                        </div>
                                        <div class="second_repayment">
                                            <label for="second_repayment">Second repayment: </label>
                                            <input type="text" disabled id="second_repayment">
                                        </div>
                                        <div class="third_repayment">
                                            <label for="third_repayment">Third repayment: </label>
                                            <input type="text" disabled id="third_repayment">
                                        </div>
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



} // end of class