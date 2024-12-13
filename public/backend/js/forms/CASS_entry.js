function offlineUpload(){
    $('#offline_class_id').change(() => {
        let $class_id = offline_class_id.value;
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
                
                $('#offline_subject_id').empty();					
                
                if(response.length > 0) {                        
                    response.forEach(Subject => {                            
                        $('#offline_subject_id').append('<option value="'+Subject.subject_id+'">'+Subject.subject_name+'</option>');
                    });						
                    
                } else {
                    $('#offline_subject_id').append('<option value"">Subject not assigned to class</option>');
                }                 
            },
            error: function(response){

            }

        });
    });
}

function downloadOffline(){
    $('#download_class_id').change(() => {
        let $class_id = offline_class_id.value;
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
                
                $('#download_subject_id').empty();					
                
                if(response.length > 0) {                        
                    response.forEach(Subject => {                            
                        $('#download_subject_id').append('<option value="'+Subject.subject_id+'">'+Subject.subject_name+'</option>');
                    });						
                    
                } else {
                    $('#download_subject_id').append('<option value"">Subject not assigned to class</option>');
                }                 
            },
            error: function(response){

            }

        });
    });
}


function onlineUpload(){
    $('#class_id').change(() => {
        let $class_id = class_id.value;
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
}



$(document).ready(() => {
    onlineUpload();
    offlineUpload();
    downloadOffline()
});
