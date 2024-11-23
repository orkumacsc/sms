$(document).ready(() => {
    $('#clas_id').change(() => {
        let $class_id = clas_id.value;
        let url = '/GetClass/' +$class_id;
        $.ajax({
            url: url,
            method: 'GET',
            data: {},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                
                $('#subject_id').empty();					
                
                if(response.length > 0) {                        
                    response.forEach(Subject => {                            
                        $('#subject_id').append('<option value="'+Subject.subject_id+'">'+Subject.subject_name+'</option>');
                    });						
                    
                } else {
                    $('#subject_id').append('<option value"">Subject not assigned to class</option>');                  
                    
                }

                                    
            },
            error: function(response){

            }

        });
    });
});

