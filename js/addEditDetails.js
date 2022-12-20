let statusInputs = false;

$('#addEditSubmit').click(function(e){
    // let staticFunctions = new StaticFunctions();
    let alertContainer = $('.alert-container');
    let alertContent = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `;

    // if(staticFunctions.addEditValidation().length != $('[data-addEditDetails]').length){
    //     if(alertContainer.children().length > 0){
    //         alertContainer.children().remove();
    //         alertContainer.append(alertContent).slideDown();
    //     } else {
    //         alertContainer.append(alertContent).slideDown();
    //     }

    //     setTimeout(function(){
    //         alertContainer.slideUp();
    //     },5000);


    //     $('.close').click(function(){
    //         alertContainer.children().remove();
    //     });

    // } else {
        statusInputs = true;
        let staticFunctions = new StaticFunctions($('[data-addEditDetails]'));
        staticFunctions.validateData();
        
    // }
    
});

$('[data-addEditDetails]').each(function(){
    $(this).keyup(function(){
        if($(this).val() != ''){
            $(this).css('border','1px solid black');
        }
    });
});


$('#addEditCancel').click(function(){
    location.href = './';
});


