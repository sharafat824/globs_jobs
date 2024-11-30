<script type="text/javascript">
$(document).ready(function() {
    //initial page structure
    $('#page_1').show();
    $('#page_2').hide();
    $('#page_3').hide();
    $('#total_block').hide();

    $("#page1_submit").click(function() {
        $('#page_1').hide();
        $('#page_2').show();
        $('#page_3').hide();
        $('#total_block').show();

        const strindID = $('.w--redirected-checked').attr('id');
        const splitString = strindID.split("_");
        const service_id = splitString[1];

        $('#service_id').val(service_id);
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>Booking/getSubServices',
            data: {
                service_id: service_id
            },
            success: function(response) {
                let data = JSON.parse(response);
                let html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<div class="val-1">';
                    html += '<label class="w-checkbox checkbox-item--brix val-1">';
                    html += '<div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox---brix" id="'+data[i].id+'" ></div>';
                    html += '<input type="checkbox" style="opacity:0;position:absolute;z-index:-1">';
                    html += '<span class="multi-step-form-label---brix no-margin---brix">'+data[i].sub_service_name+' <br>'+data[i].type+'</span>';
                    html += '</label>';
                    html += '</div>';
                }
                $('#sub_services').html(html);
            }
        });

    });

    $("#page2_back").click(function() {
        $('#page_1').show();
        $('#page_2').hide();
        $('#page_3').hide();
        $('#total_block').hide();
    });

    $("#page2_submit").click(function() {
        $('#page_1').hide();
        $('#page_2').hide();
        $('#page_3').show();
    });

    $("#page3_back").click(function() {
        $('#page_1').hide();
        $('#page_2').show();
        $('#page_3').hide();
    });

    //click on the Services
    $(".mainDiv").click(function() {
        const id = $(this).attr('id');
        $('#' + id).toggleClass("w--redirected-checked");
    });



});
</script>