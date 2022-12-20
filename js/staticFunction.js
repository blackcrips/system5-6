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
                        let overlay = $('#overlay');
                        let overlayContent = $('#overlay-content');
                        let sampleThis = new StaticFunctions();

                            $('#overlay').addClass('active');
                            overlayContent.addClass('active');
                            $('#body').css('overflow','hidden');
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
        setTimeout(function(){
            overlayContent.children('#overlay-details').children().remove();
        },1000);
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
                                        <input type="file" name="attachment1" id="attachment1" hidden>
                                        <input type="file" name="attachment2" id="attachment2" hidden>
                                        <input type="file" name="attachment3" id="attachment3" hidden>
                                        <span id="span1">Attachment 1</span>
                                        <span id="span2">Attachment 2</span>
                                        <span id="span3">Attachment 3</span>
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

            let sampleThis = new StaticFunctions();

            $('#overlay-cancel').click(function(){
                sampleThis.removeClasses();
            });
    }

}