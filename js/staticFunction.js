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
                        sampleThis.hey();
                    }
                    
                }
            } 
        );

        
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
}