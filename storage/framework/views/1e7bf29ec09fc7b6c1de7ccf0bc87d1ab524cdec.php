<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>India Property Clinic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/all.css')); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/skins/_all-skins.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/custom.css')); ?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <div class='notifications top-right'></div>

<?php echo $__env->make('layouts.adminLayout.admin_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.adminLayout.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('layouts.adminLayout.admin_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- DataTables -->
<script src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap  -->
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('bower_components/chart.js/Chart.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- InputMask -->
<script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo e(asset('bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo e(asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo e(asset('plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo e(asset('plugins/iCheck/icheck.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('bower_components/fastclick/lib/fastclick.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.js"></script>

<!-- CK Editor -->
<!-- <script src="<?php echo e(asset('bower_components/ckeditor/ckeditor.js')); ?>"></script> -->
<!-- <script src="<?php echo e(asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script> -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<!-- Custom js for Admin -->
<script src="<?php echo e(asset('dist/js/custom.js')); ?>"></script>

<script>
  // Creating Property URL
    $('#property_name').change(function(e) {
        $.get('<?php echo e(url("/add-new-property/check_slug")); ?>', 
          { 'property_name': $(this).val() }, 
          function( data ) {
            $('#slug').val(data.slug);
          }
        );
    });

    // Creating PPC Page URL
    $('#title').change(function(e) {
        $.get('<?php echo e(url("/add-new-ppc-page/check_slug")); ?>', {
                'title': $(this).val()
            },
            function(data) {
                $('#slug').val(data.slug);
            }
        );
    });

    // Creating Repair Service URL
    $('#rservice_name').change(function(e) {
      $.get('<?php echo e(url("/repair-services/check_slug")); ?>', 
        { 'rservice_name': $(this).val() }, 
        function( data ) {
          $('#slug').val(data.slug);
      });
    });

    $(function() {
        $("#CMSPageType").change(function() {
            if ($(this).val() == '1') {
                // $("#CMSPageTemplates").show();
                $('#CMSPageTemplates').removeClass('hidden').addClass('show');
            } else {
              $('#CMSPageTemplates').removeClass('show').addClass('hidden');
                // $("#CMSPageCountry").hide();
            }
        });

        $("#CMSPageType").change(function() {
            if ($(this).val() == '2') {
                // $("#CMSPageCountry").show();
                $('#CMSPageCountry').removeClass('hidden').addClass('show');
                $('#CMSPageState').removeClass('hidden').addClass('show');
                $('#CMSPageCity').removeClass('hidden').addClass('show');
                $('#CMSPageCSC').removeClass('hidden').addClass('show');
                $('#CMSPageBRS').removeClass('hidden').addClass('show');
            } else {
                // $("#CMSPageCountry").hide();
                $('#CMSPageCountry').removeClass('show').addClass('hidden');
                $('#CMSPageState').removeClass('show').addClass('hidden');
                $('#CMSPageCity').removeClass('show').addClass('hidden');
                $('#CMSPageCSC').removeClass('show').addClass('hidden');
                $('#CMSPageBRS').removeClass('show').addClass('hidden');
            }
        });
    });


// Check User Email
$('#email').blur(function()
{
  var error_email = '';
  var email = $('#email').val();
  var _token = $('input[name="_token"]').val();
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!filter.test(email))
  {    
   $('#error_email').html('<label class="text-danger">Invalid Email</label>');
   $('#email').addClass('has-error');
  }
  else
  {
   $.ajax({
    url:"<?php echo e(url('/checkemail')); ?>",
    method:"POST",
    data:{email:email, _token:_token},
    success:function(result)
    {
     if(result == 'unique')
     {
      $('#error_email').html('<label class="text-success">Email Available</label>');
      $('#email').removeClass('has-error');
     }
     else
     {
      $('#error_email').html('<label class="text-danger">Email already exist.</label>');
      $('#email').addClass('has-error');
     }
    }
   })
  }
 });
 
 // Check User Phone Number
    $('#phone').blur(function() {
      var error_phone = '';
      var phone = $('#phone').val();
      var _token = $('input[name="_token"]').val();
      // var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      // if (!filter.test(phone)) {
      //   $('#error_phone').html('<label class="text-danger">Invalid Phone</label>');
      //   $('#phone').addClass('has-error');
      // } else {
        $.ajax({
          url: "<?php echo e(url('/checkuserphone')); ?>",
          method: "POST",
          data: {
            phone: phone,
            _token: _token
          },
          success: function(res) {
            if (res == 'unique') {
              $('#error_phone').html('<label class="text-success">Phone Available</label>');
              $('#phone').removeClass('has-error');
            } else{
              $('#error_phone').html('<label class="text-danger">Phone already exist.</label>');
              $('#phone').addClass('has-error');
            }
          }
        })
      // }
    });
</script>

<script>
  $('#new_pwd').click(function(){
    var current_pwd = $('#current_pwd').val();
    // alert(current_pwd);
    $.ajax({
        type: 'get',
        url: '/admin/check-pwd',
        data: {current_pwd:current_pwd},
        success: function(resp){
            if(resp=="false"){
                $('#chkPwd').html('<font color=red>Current Password is Incorrect!</font>');
            }else{
                $('#chkPwd').html('<font color=green>Current Password is Correct!</font>');
            }
        },error:function(){
            alert("error");
        }
    });
});
</script>

<script>
  <?php if(Session::has('flash_message_success')): ?>
     $('.top-right').notify({
        message: { text: "<?php echo e(Session::get('flash_message_success')); ?>" },
        // fadeOut: { enabled: true, delay: 3000 }
        transition: 'fade'
      }).show();
     <?php
       Session::forget('flash_message_success');
     ?>
  <?php endif; ?>

  <?php if(Session::has('flash_message_error')): ?>
      $('.top-right').notify({
        message: { text: "<?php echo e(Session::get('flash_message_error')); ?>" },
        // fadeOut: { enabled: true, delay: 3000 },
        type:'error',
        transition: 'fade'
      }).show();
      <?php
        Session::forget('flash_message_error');
      ?>
  <?php endif; ?>
</script>

<script>
    // Get Sub Services List Ajax Fetch for PPC Pages
    $('#MainServiceList').change(function() {
        var parentID = $(this).val();
        var _token = $('input[name="_token"]').val();
        if (parentID) {
            $.ajax({
                type: "get",
                url: "get-services-list?parent_id=" + parentID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#SubServiceList").empty();
                        $("#SubServiceList").append(
                            '<option value=""> -- Select Service -- </option>');
                        $.each(res, function(key, value) {
                            $("#SubServiceList").append('<option value="' + key + '">' +
                                value +
                                '</option>');
                        });
                    } else {
                        $("#SubServiceList").empty();
                    }
                }
            });
        } else {
            $("#SubServiceList").empty();
        }
    });

    // Get Subs Services List Ajax Fetch
    $('#SubServiceList').change(function() {
        var parentID = $(this).val();
        var _token = $('input[name="_token"]').val();
        if (parentID) {
            $.ajax({
                type: "get",
                url: "get-services-list?parent_id=" + parentID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#SubsServiceList").empty();
                        $("#SubsServiceList").append(
                            '<option value=""> -- Select Service -- </option>');
                        $.each(res, function(key, value) {
                            $("#SubsServiceList").append('<option value="' + key + '">' +
                                value +
                                '</option>');
                        });
                    } else {
                        $("#SubsServiceList").empty();
                    }
                }
            });
        } else {
            $("#SubsServiceList").empty();
        }
    });
    </script>

</body>
</html><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/layouts/adminLayout/admin_design.blade.php ENDPATH**/ ?>