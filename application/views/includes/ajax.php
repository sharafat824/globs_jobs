<script>
$(document).ready(function() {
    $('#shop_details').change(function() {
        var shop_details = $('#shop_details').val();

        if (shop_details != '') {
                //  alert(shop_details);
            $.ajax({
                url: "<?php echo base_url()?>FieldVisibility/Request/fetch_shop_details",
                method: "post",
                type: "json",
                data: {
                    'shop_details': shop_details
                },
                success: function(data) {
                    $('#shop_code_detail').html(data);
                        //    alert(data);
                }
            });
        }
    });
});
</script>

<script type="text/javascript'); ?>"/>

    
    $("#role").change(function () {
        var rolecode = document.getElementById("role").value;
        if (rolecode == 'FT' ) {
            $("#region").prop("disabled", false);
            $("#agency").prop("disabled", true);
            $("#city").prop("disabled", true);
            $("#area").prop("disabled", true);
        }
        if (rolecode == 'SUPERADMIN' || rolecode == 'Brand' || rolecode == 'Channel' || rolecode == 'Category' || rolecode == 'CIIC'|| rolecode == 'VT' ) {
            $("#region").prop("disabled", true);
            $("#city").prop("disabled", true);
            $("#area").prop("disabled", true);
            $("#agency").prop("disabled", true);
        }
        if (rolecode == 'Agency' || rolecode == 'AgencyPortal') {
            $("#region").prop("disabled", false);
            $("#city").prop("disabled", false);
            $("#area").prop("disabled", false);
            $("#agency").prop("disabled", false);
        }
        
    });
</script>