<?php /* D:\Laravel\PropertyAdmin\resources\views/layouts/frontLayout/frontend_design.blade.php */ ?>
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'India Property Clinic')); ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/passtrength.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/frontend_css/jquery.mmenu.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/style.css')); ?>">
    
</head>
<body >

<?php echo $__env->make('layouts.frontLayout.header_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('layouts.frontLayout.footer_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('js/frontend_js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/frontend_js/owl.carousel.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('js/frontend_js/jquery.passtrength.js')); ?>"></script> -->
    <script src="<?php echo e(asset('js/frontend_js/custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/jquery.mmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('js/frontend_js/tagsinput.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/emicalc-lib.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/emicalc-main.min.js')); ?>"></script>

    <script type="text/javascript">
    $(function() {
        $("#PropertyType").change(function() {
            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1012" || $(this).val() == "1014" || $(this).val() == "1016") {
                $("#MapPassed").show();
            } else {
                $("#MapPassed").hide();
            }

            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this).val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
                $("#OpenSides").show();
            } else {
                $("#OpenSides").hide();
            }

            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this).val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
                $("#WidthRoadFacing").show();
            } else {
                $("#WidthRoadFacing").hide();
            }

            // if ($(this).val() == "1001" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017") {
            //     $("#BoundryWall").show();
            // } else {
            //     $("#BoundryWall").hide();
            // }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1018") {
                $("#Bedrooms").show();
            } else {
                $("#Bedrooms").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1011" || $(this).val() == "1018") {
                $("#Bathrooms").show();
            } else {
                $("#Bathrooms").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007") {
                $("#Balconies").show();
            } else {
                $("#Balconies").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1013" || $(this).val() == "1018") {
                $("#FurnishStatus").show();
            } else {
                $("#FurnishStatus").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1013") {
                $("#FloorNo").show();
            } else {
                $("#FloorNo").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1015" || $(this).val() == "1018" || $(this).val() == "1013") {
                $("#TotalFloor").show();
            } else {
                $("#TotalFloor").hide();
            }

            if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010") {
                $("#PWashroom").show();
            } else {
                $("#PWashroom").hide();
            }

            if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011") {
                $("#Cafeteria").show();
            } else {
                $("#Cafeteria").hide();
            }

            if ($(this).val() == "1010" || $(this).val() == "1011") {
                $("#IsRoadFacing").show();
            } else {
                $("#IsRoadFacing").hide();
            }

            if ($(this).val() == "1011") {
                $("#PShowroom").show();
            } else {
                $("#PShowroom").hide();
            }

            if ($(this).val() == "1010" || $(this).val() == "1011") {
                $("#CornerShop").show();
            } else {
                $("#CornerShop").hide();
            }

            if ($(this).val() == "1001" || $(this).val() == "1012" || $(this).val() == "1014" || $(this).val() == "1017") {
                $("#BoundryWall").show();
            } else {
                $("#BoundryWall").hide();
            }

            if ($(this).val() == "1019") {
                $("#AppleTrees").show();
            } else {
                $("#AppleTrees").hide();
            }

        });
    });
    </script>

<script>
    //Homepage search js
$(document).ready(function(){
  $('.search_location').keyup(function(){ 
    var query = $(this).val();
    if(query != ''){
      var _token = $('input[name="_token"]').val();
      
      $.ajax({
        url:"/search",
        method:"POST",
        data:{query:query, _token:_token},
        success:function(data){
          $('#searchlist').fadeIn(); 
          $('#searchlist').html(data);
        }
      });
    }
  });

  $(document).on('click', 'li', function(){ 
    $('#search_name').val($(this).text()); 
    $('#searchlist').fadeOut(); 
  }); 

  $(document).on('click', function(){ 
    $('#searchlist').fadeOut(); 
  });

  $(document).keyup(function(e) {
    if (e.key === "Escape") { 
      $('#searchlist').fadeOut(); 
    }
  });
});
</script>

  </body>
</html>