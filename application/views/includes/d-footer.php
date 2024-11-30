 
      <div class="go-top">
         <i class="ri-arrow-up-line"></i>
      </div>
      <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.meanmenu.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.appear.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/odometer.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/fancybox.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/selectize.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/TweenMax.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/aos.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/metismenu.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/simplebar.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/dropzone.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/sticky-sidebar.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.ajaxchimp.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/form-validator.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/contact-form-script.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/wow.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/main.js'); ?>"/></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"/></script>
	  <!--Toastr js-->
<script src="<?php echo base_url('assets/plugins/toastr/build/toastr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/toaster/garessi-notif.js'); ?>"></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


</body>
   
</html>
<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en'
    }, 'google_translate_element');
}
</script>
<script>
$(document).ready(function() {

    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });



    $('#country').change(function() {
        var region_id = $('#country').val();

        if (region_id != '') {
            //      alert(city_id);
            $.ajax({
                url: "<?php echo base_url()?>Candidate/fetch_city",
                method: "get",
                type: "json",
                data: {
                    'region': region_id
                },
                success: function(data) {
                    $('#town').html(data);
                          //  alert(data);
                }
            });
        } else {
            $('#town').html('<option value="">Select Town/City</option>');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('#nationality').change(function() {
        var region_id = $('#nationality').val();

        if (region_id != '') {
            //      alert(city_id);
            $.ajax({
                url: "<?php echo base_url()?>Candidate/fetch_city",
                method: "get",
                type: "json",
                data: {
                    'region': region_id
                },
                success: function(data) {
                    $('#birth_city').html(data);
                          //  alert(data);
                }
            });
        } else {
            $('#birth_city').html('<option value="">Select Town/City</option>');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $.ajax({
        url: "<?php echo base_url()?>Candidate/fetch_county",
        method: "get",
        type: "json",
        data: {},
        success: function(data) {
            $('#country').html(data);
            $('#nationality').html(data);
        }
    });
});
</script>


<script>
function confirmDialog1() {
    return confirm("Are you sure you want to Approve?")
}
function confirmDialog2() {
    return confirm("Are you sure you want to Reject?")
}
function confirmDialog3() {
    return confirm("Are you sure you want to delete?")
}
</script>
 <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
  <script>
	
	
	 
	function showDiv(divId, element)
{
	//alert("hello");
    document.getElementById(divId).style.display = element.value == 2 ? '' : 'none';
}
		
		

	</script>
	

  <style>
  	div#ui-datepicker-div {
    background: #fff;
}
  </style>

