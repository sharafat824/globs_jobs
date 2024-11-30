<script>
    <?php if ($this->session->flashdata('success')) { ?>
        $(document).ready(function(){
         toastr.info('<?php echo $this->session->flashdata('success'); ?>', 'Message');
          });
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        $(document).ready(function(){
            toastr.error('<?php echo $this->session->flashdata('error'); ?>', 'Message');
          });
    <?php } ?>
</script>