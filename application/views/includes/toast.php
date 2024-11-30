<script>
    <?php if ($this->session->flashdata('success')) { ?>
        $(document).ready(function(){
         toastr.success('<?php echo $this->session->flashdata('success'); ?>', 'Message');
          });
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        $(document).ready(function(){
            toastr.error('<?php echo $this->session->flashdata('error'); ?>', 'Message');
          });
    <?php } ?>
    <?php if ($this->session->flashdata('error1')) { ?>
        $(document).ready(function(){
            toastr.error('<?php echo $this->session->flashdata('error1'); ?>', 'Message');
          });
    <?php } ?>
    <?php if ($this->session->flashdata('error2')) { ?>
        $(document).ready(function(){
            toastr.error('<?php echo $this->session->flashdata('error2'); ?>', 'Message');
          });
    <?php } ?>
</script>