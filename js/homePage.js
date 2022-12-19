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
                    <td>active</td>
                    <td><form action='./includes/addEditDetails.inc.php' method='POST'>
                            <button type='submit' class='btn btn-primary buttons'>View</button>
                            <input type='text' hidden name='list_id' value='${parseData[i].id}' />
                            <button class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                    </tr>`;

                    $('#listInfo__tableBody').append(listDataTamplate);
                }
                
                $('#listInfo-table').DataTable();
            }
        }
    );
});
