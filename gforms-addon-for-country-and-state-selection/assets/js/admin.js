// filter state by country using ajax
jQuery(document).ready(function($) {
    $('div[name="country_state_fliter"]').each(function() {        
        const field_id = $(this).attr("id");
        var formid = field_id.substr(6, 1);
        $(document).on('change','#' + field_id + ' ' + 'select[id="' + field_id + '_1"]',function() {  
            $('select[id="' + field_id + '_2"]').addClass('stateselection');
            let country = $('select[id="' + field_id + '_1"] option:selected').val();
            $('select[id="' + field_id + '_2"] option').remove();
            // $('#' + field_id + ' ' + '.loader').fadeIn(); 
            $('#' + field_id + ' ' + 'select[id="' + field_id + '_2"]').attr('disabled','disabled');        
            $.ajax({
                type: 'get',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'Ajax_GFCWS_Filter_Record',
                    country: country,
                },
                dataType: 'json',
                cache: false,
                success: function(data) {
                    $('#' + field_id + ' ' + 'select[id="' + field_id + '_2"]').html(data[0]); 
                    // $('#' + field_id + ' ' + '.loader').fadeOut();
                    $('#' + field_id + ' ' + 'select[id="' + field_id + '_2"]').removeAttr('disabled');   
                    $('select[id="' + field_id + '_2"]').removeClass('stateselection');
                }
            });           
        })
    })
});