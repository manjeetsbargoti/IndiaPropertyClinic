<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <?php if(empty($index_status)): ?>
    <!-- <meta name="robots" content="noindex"> -->
    <?php endif; ?>

    <?php // print_r($service); ?>
    <!-- for Google -->
    <meta name="title" content="<?php if(!empty($meta_title)): ?><?php echo e($meta_title); ?><?php endif; ?>" />
    <meta name="description" content="<?php if(!empty($meta_description)): ?><?php echo e($meta_description); ?><?php endif; ?>" />
    <meta name="keywords" content="<?php if(!empty($meta_keywords)): ?><?php echo e($meta_keywords); ?><?php endif; ?>" />
    <link rel="canonical" href="<?php if(!empty($canonical_url)): ?><?php echo e($canonical_url); ?><?php endif; ?>" />
    <meta name="copyright" content="Copyright (C) Since 2019 - This Content is owned by <?php echo e(config('app.name')); ?>" />

    <!-- for Facebook -->
    <meta property="og:title" content="<?php if(!empty($meta_title)): ?><?php echo e($meta_title); ?><?php endif; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="<?php if(!empty($meta_description)): ?><?php echo e($meta_description); ?><?php endif; ?>" />
    <meta property="og:image" content="<?php if(!empty($page_image)): ?><?php echo e($page_image); ?><?php endif; ?>" />
    <meta property="og:url" content="<?php if(!empty($canonical_url)): ?><?php echo e($canonical_url); ?><?php endif; ?>" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php if(!empty($meta_title)): ?><?php echo e($meta_title); ?><?php endif; ?>" />
    <meta name="twitter:description" content="<?php if(!empty($meta_description)): ?><?php echo e($meta_description); ?><?php endif; ?>" />
    <meta name="twitter:image" content="<?php if(!empty($page_image)): ?><?php echo e($page_image); ?><?php endif; ?>" />
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php if(!empty($meta_title)): ?><?php echo e($meta_title); ?><?php endif; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset(config('app.favicon'))); ?>" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!--<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/passtrength.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/frontend_css/jquery.mmenu.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend_css/style.css')); ?>">


    <?php echo $__env->make('admin.system.partials.code_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>

    <?php echo $__env->make('layouts.frontLayout.header_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.frontLayout.footer_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('js/frontend_js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/jquery.mmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('js/frontend_js/tagsinput.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/emicalc-lib.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/emicalc-main.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend_js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/frontend_js/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('js/frontend_js/custom.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js">
    </script>


    <script>
    $("#OfferedBService").change(function() {
        if ($(this).val() != '') {
            $('#BusinessInformation').removeClass('d-none').addClass('d-block');
        } else {
            $('#BusinessInformation').removeClass('d-block').addClass('d-none');
        }
    });
    </script>

    <script type="text/javascript">
    $(function() {
        $("#PropertyType").change(function() {
            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1012" || $(this)
                .val() == "1014" || $(this).val() == "1016") {
                $("#MapPassed").show();
            } else {
                $("#MapPassed").hide();
            }

            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this)
                .val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this)
                .val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
                $("#OpenSides").show();
            } else {
                $("#OpenSides").hide();
            }

            if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this)
                .val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this)
                .val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
                $("#WidthRoadFacing").show();
            } else {
                $("#WidthRoadFacing").hide();
            }

            // if ($(this).val() == "1001" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017") {
            //     $("#BoundryWall").show();
            // } else {
            //     $("#BoundryWall").hide();
            // }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1005" || $(this).val() == "1006" || $(this).val() == "1018") {
                $("#Bedrooms").show();
            } else {
                $("#Bedrooms").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this)
                .val() == "1008" || $(this).val() == "1009" || $(this).val() == "1011" || $(this)
                .val() ==
                "1018") {
                $("#Bathrooms").show();
            } else {
                $("#Bathrooms").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007") {
                $("#Balconies").show();
            } else {
                $("#Balconies").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this)
                .val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this)
                .val() ==
                "1011" || $(this).val() == "1013" || $(this).val() == "1018") {
                $("#FurnishStatus").show();
            } else {
                $("#FurnishStatus").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this)
                .val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this)
                .val() ==
                "1013") {
                $("#FloorNo").show();
            } else {
                $("#FloorNo").hide();
            }

            if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this)
                .val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this)
                .val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this)
                .val() ==
                "1011" || $(this).val() == "1015" || $(this).val() == "1018" || $(this).val() == "1013"
            ) {
                $("#TotalFloor").show();
            } else {
                $("#TotalFloor").hide();
            }

            if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010") {
                $("#PWashroom").show();
            } else {
                $("#PWashroom").hide();
            }

            if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this)
                .val() == "1011") {
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

            if ($(this).val() == "1001" || $(this).val() == "1012" || $(this).val() == "1014" || $(this)
                .val() == "1017") {
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
    $(document).ready(function() {
        $('.search_location').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/search",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#searchlist').fadeIn();
                        $('#searchlist').html(data);
                    }
                });
            }
        });

        $(document).on('click', 'li', function() {
            $('#search_name').val($(this).text());
            $('#searchlist').fadeOut();
        });

        $(document).on('click', function() {
            $('#searchlist').fadeOut();
        });

        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                $('#searchlist').fadeOut();
            }
        });
    });
    </script>
    <script>
    // Check User Email
    $('#email').blur(function() {
        var error_email = '';
        var email = $('#email').val();
        var _token = $('input[name="_token"]').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            $('#error_email').html('<label class="text-danger">Invalid Email</label>');
            $('#email').addClass('has-error');
        } else {
            $.ajax({
                url: "<?php echo e(url('/checkuseremail')); ?>",
                method: "POST",
                data: {
                    email: email,
                    _token: _token
                },
                success: function(result) {
                    if (result == 'unique') {
                        $('#error_email').html(
                            '<label class="text-success">Email Available</label>');
                        $('#email').removeClass('has-error');
                    } else {
                        $('#error_email').html(
                            '<label class="text-danger">Email already exist.</label>');
                        $('#email').addClass('has-error');
                    }
                }
            })
        }
    });

    // Check User Email for List Property
    $('#ListEmail').blur(function() {
        var error_email = '';
        var email = $('#ListEmail').val();
        var _token = $('input[name="_token"]').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            $('#error_email').html('<label class="text-danger">Invalid Email</label>');
            $('#ListEmail').addClass('has-error');
        } else {
            $.ajax({
                url: "<?php echo e(url('/checkemail')); ?>",
                method: "POST",
                data: {
                    email: email,
                    _token: _token
                },
                success: function(result) {
                    if (result == 'unique') {
                        $('#error_email').html(
                            '<label class="text-success">Email Available</label>');
                        $('#ListEmail').removeClass('has-error');
                    } else {
                        $('#error_email').html(
                            '<label class="text-danger">You are already Registered!.</label>');
                        $('#ListEmail').addClass('has-error');
                    }
                }
            })
        }
    });

    // Check User Phone while Listing Property
    $('#ListPhone').blur(function() {
        var error_listphone = '';
        var phone = $('#ListPhone').val();
        var _token = $('input[name="_token"]').val();
        //   var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (document.getElementById('ListPhone').value === '') {
            $('#error_listphone').html('<label class="text-danger">Invalid Phone</label>');
            $('#ListPhone').addClass('has-error');
        } else {
            $.ajax({
                url: "<?php echo e(url('/checkuserphone')); ?>",
                method: "POST",
                data: {
                    phone: phone,
                    _token: _token
                },
                success: function(res) {
                    if (res == 'unique') {
                        $('#error_listphone').html(
                            '<label class="text-success">Phone Available</label>');
                        $('#ListPhone').removeClass('has-error');
                    } else {
                        $('#error_listphone').html(
                            '<label class="text-danger">Phone Number already exist.</label>');
                        $('#ListPhone').addClass('has-error');
                    }
                }
            })
        }
    });
    </script>

    <script>
    // Check user email while verifing email for reset password
    $('#VerifyResetEmailPassword').blur(function() {
        var error_verifyemail = '';
        var email = $('#VerifyResetEmailPassword').val();
        var _token = $('input[name="_token"]').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            $('#error_verifyemail').html('<label class="text-danger">Incorrect Email</label>');
            $('#VerifyResetEmailPassword').addClass('has-error');
        } else {
            $.ajax({
                url: "<?php echo e(url('/checkuseremail')); ?>",
                method: "POST",
                data: {
                    email: email,
                    _token: _token
                },
                success: function(result) {
                    if (result == 'unique') {
                        $('#error_verifyemail').html(
                            '<label class="text-danger">Incorrect Email!</label>');
                        $('#VerifyResetEmailPassword').addClass('has-error');
                    } else {
                        $('#error_verifyemail').html(
                            '<label class="text-success">Correct Email!</label>');
                        $('#VerifyResetEmailPassword').removeClass('has-error');
                    }
                }
            })
        }
    });

    function verifyEmailBtnActivation() {
        if (!document.getElementById('VerifyResetEmailPassword').value.length) {
            document.getElementById("VerifyEmilReset").disabled = true;
        } else {
            document.getElementById("VerifyEmilReset").disabled = false;
        }
    }
    </script>

    <script>
    // Country, State, City Ajax Fetch
    $('#country').change(function() {
        var countryID = $(this).val();
        var _token = $('input[name="_token"]').val();
        if (countryID) {
            $.ajax({
                type: "get",
                url: "get-state-list?country_id=" + countryID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option value="">Select State</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
            $("#city").empty();
        }
    });
    // Get City List According to state
    $('#state').on('change', function() {
        var stateID = $(this).val();
        if (stateID) {
            $.ajax({
                type: "GET",
                url: "get-city-list?state_id=" + stateID,
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $("#city").append('<option value="">Select City</option>');
                        $.each(res, function(key, value) {
                            $("#city").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {
                        $("#city").empty();
                    }
                }
            });
        } else {
            $("#city").empty();
        }
    });

    // Creating Property URL
    $('#property_name').change(function(e) {
        $.get('<?php echo e(url("/list-property/check_slug")); ?>', {
                'property_name': $(this).val()
            },
            function(data) {
                $('#slug').val(data.slug);
            }
        );
    });
    </script>

    <script>
    $('.navBtn').click(function(event) {
        event.preventDefault();
        var target = $(this).data('target');
        // console.log('#'+target);
        $('#click-alert').html('data-target= ' + target).fadeIn(50).delay(3000).fadeOut(1000);

    });

    // Multi-Step Form
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTabRF(currentTab); // Display the crurrent tab

    function showTabRF(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtnRF").style.display = "none";
        } else {
            document.getElementById("prevBtnRF").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtnRF").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtnRF").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicatorRF(n)
    }

    function nextPrevRF(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateFormRF()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("ServiceQuery").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTabRF(currentTab);
    }

    function validateFormRF() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("emptyformvalidations");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step_rf")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicatorRF(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step_rf");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    </script>

    <script>
    //Homepage search js
    $(document).ready(function() {
        $('.search_citylocation').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/city_list",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#allcitylist').fadeIn();
                        $('#allcitylist').html(data);
                    }
                });
            }
        });

        $(document).on('click', '#type_search', function() {
            $('#city_name_id').val($(this).text());
            $('#allcitylist').fadeOut();
        });

        $(document).on('click', function() {
            $('#allcitylist').fadeOut();
        });

        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                $('#searchlist').fadeOut();
            }
        });
    });
    </script>

    <script>
    // Get Sub Services List Ajax Fetch
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

    // Get Sub Services List Ajax Fetch On Single Property Page
    $('#MainServiceOnList').change(function() {
        var parentID = $(this).val();
        var PageURI = $('#PageURI').val();
        var _token = $('input[name="_token"]').val();
        if (parentID) {
            $.ajax({
                type: "get",
                url: "/services/" + PageURI + "/get-services-list?parent_id=" + parentID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#SubServiceOnList").empty();
                        $("#SubServiceOnList").append(
                            '<option value=""> -- Select Service -- </option>');
                        $.each(res, function(key, value) {
                            $("#SubServiceOnList").append('<option value="' + key + '">' +
                                value +
                                '</option>');
                        });
                    } else {
                        $("#SubServiceOnList").empty();
                    }
                }
            });
        } else {
            $("#SubServiceOnList").empty();
        }
    });

    // Get Subs Services List Ajax Fetch On Single Property Page
    $('#SubServiceOnList').change(function() {
        var parentID = $(this).val();
        var PageURI = $('#PageURI').val();
        var _token = $('input[name="_token"]').val();
        if (parentID) {
            $.ajax({
                type: "get",
                url: "/services/" + PageURI + "/get-services-list?parent_id=" + parentID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#SubsServiceOnList").empty();
                        $("#SubsServiceOnList").append(
                            '<option value=""> -- Select Service -- </option>');
                        $.each(res, function(key, value) {
                            $("#SubsServiceOnList").append('<option value="' + key + '">' +
                                value +
                                '</option>');
                        });
                    } else {
                        $("#SubsServiceOnList").empty();
                    }
                }
            });
        } else {
            $("#SubsServiceOnList").empty();
        }
    });

    // Get State List Ajax Fetch
    $('#country_list').change(function() {
        var countryID = $(this).val();
        var _token = $('input[name="_token"]').val();
        if (countryID) {
            $.ajax({
                type: "get",
                url: "get-state-list?country_id=" + countryID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#StateList").empty();
                        $("#StateList").append('<option> -- Select State -- </option>');
                        $.each(res, function(key, value) {
                            $("#StateList").append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    } else {
                        $("#StateList").empty();
                    }
                }
            });
        } else {
            $("#StateList").empty();
        }
    });

    // Get State List Ajax Fetch on Sigle Service Page
    $('#country_listOn').change(function() {
        var countryID = $(this).val();
        var Page_URI = $('#PageURI').val();
        var _token = $('input[name="_token"]').val();
        if (countryID) {
            $.ajax({
                type: "get",
                url: "/services/" + Page_URI + "/get-state-list?country_id=" + countryID,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res) {
                        $("#StateOnList").empty();
                        $("#StateOnList").append('<option> -- Select State -- </option>');
                        $.each(res, function(key, value) {
                            $("#StateOnList").append('<option value="' + key + '">' +
                                value +
                                '</option>');
                        });
                    } else {
                        $("#StateOnList").empty();
                    }
                }
            });
        } else {
            $("#StateOnList").empty();
        }
    });
    </script>

    <?php echo $__env->make('admin.system.partials.code_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/frontend_design2.blade.php ENDPATH**/ ?>