<!-- REQUIRED JS SCRIPTS -->
  
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->

<!-- Laravel App -->
<script src="<?php echo e(url (mix('/js/app.js'))); ?>" type="text/javascript"></script> 



<!-- Date Picker JS --> 
<script src="<?php echo e(asset('/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- Date Picker JS - languaje -->
<script src="<?php echo e(asset('/locales/bootstrap-datepicker.es.min.js')); ?>"></script>


<script src="<?php echo e(asset('/js/main.js')); ?>" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
