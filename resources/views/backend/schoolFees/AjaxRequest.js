<script>
$(document).ready(() => {
    $('#clas_id').change(() => {

        let id = clas_id.value;
        let url = '/GetStudent/'+id;	

        $.ajax({
            url: url,
            method: 'GET',
            data: {},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                $('#student_id').empty();
                response.forEach(Student => {						
                    $('#student_id').append('<option value="'+Student.id+'">'+Student.surname+', '+Student.firstname+' '+Student.middlename+'</option>');
                });
            },
            error: function(response){

            }

        });
    });
});


$(document).ready(() => {
    $('#fees_id').change(() => {
        let fee_id = fees_id.value;
        let url = '/FeesResponse/' +fee_id;
        $.ajax({
            url: url,
            method: 'GET',
            data: {},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){					
                $('#add').append('<input type="text" value="&#8358;'+response.fee_amount+'" class="form-control" disabled name="fee_amount" id="fee_amount">')
            },
            error: function(response){

            }

        });
    });
});

</script>