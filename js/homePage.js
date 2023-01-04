let clientDetails;

$(document).ready(function(){
    $.ajax(
        {
            url: './includes/getAllRecords.inc.php',
            method: 'POST',
            data: {'request-data': 'getAll'},
            success: function(data){
                let parseData = JSON.parse(data);
                for(let i = 0; i < parseData.length; i++){
                    let listDataTamplate = `<tr>
                    <td>${parseData[i].lastname}</td>
                    <td>${parseData[i].firstname}</td>
                    <td>${parseData[i].middlename}</td>
                    <td>${parseData[i].contact_no}</td>
                    <td>${parseData[i].alternate_contact_no}</td>
                    <td>${parseData[i].address}</td>
                    <td>${parseData[i].status}</td>
                    <td><form action='./includes/addEditDetails.inc.php' method='POST'>
                            <button type='submit' class='btn btn-primary buttons' name='button-view'>View</button>
                            <input type='text' hidden name='list_id' id='list_id' value='${parseData[i].id}' />
                            <button type='button' class='btn btn-success btn_installment'>Installment</button>
                            <button type='button' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                    </tr>`;

                    $('#listInfo__tableBody').append(listDataTamplate);
                }
                
                $('#listInfo-table').DataTable(
                    {
                        "fnDrawCallback": function( oSettings ){
                            $('#listInfo-table tbody tr td form .btn_installment').each(function() {
                                $(this).click(() => {
                                    let sampleThis = new StaticFunctions();
                                    sampleThis.getSingleDetails($(this).prev().val());
                                    sampleThis.createOverlay();
                                   
                                })
                              }); 
                        }
                    }
                );
            }
        }
    );
});

