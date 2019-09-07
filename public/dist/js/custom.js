// Creating Service URL
$('#rservice_name').keyup(function() {
    var str = $(this).val();
    var trims = $.trim(str);
    var rservice_url = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
    $('#rservice_url').val(rservice_url.toLowerCase());
});

$('#CMSPageTitle').keyup(function() {
    var str = $(this).val();
    var trims = $.trim(str);
    var cms_slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
    $('#CMSslug').val(cms_slug.toLowerCase());
});

// Data fields according to Property Type Selection
$(function() {
    $("#PropertyType").change(function() {
        if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1012" || $(this).val() == "1014" || $(this).val() == "1016") {
            $("#MapPassed").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#MapPassed").hide();
        }

        if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this).val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
            $("#OpenSides").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#OpenSides").hide();
        }

        if ($(this).val() == "1001" || $(this).val() == "1002" || $(this).val() == "1005" || $(this).val() == "1012" || $(this).val() == "1013" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017" || $(this).val() == "1018") {
            $("#WidthRoadFacing").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#WidthRoadFacing").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1018" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#Bedrooms").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#Bedrooms").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1011" || $(this).val() == "1018" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#Bathrooms").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#Bathrooms").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#Balconies").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#Balconies").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1013" || $(this).val() == "1018" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#FurnishStatus").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#FurnishStatus").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1013" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#FloorNo").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#FloorNo").hide();
        }

        if ($(this).val() == "1002" || $(this).val() == "1003" || $(this).val() == "1004" || $(this).val() == "1005" || $(this).val() == "1006" || $(this).val() == "1007" || $(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1015" || $(this).val() == "1018" || $(this).val() == "1013") {
            $("#TotalFloor").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#TotalFloor").hide();
        }

        if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010") {
            $("#PWashroom").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#PWashroom").hide();
        }

        if ($(this).val() == "1008" || $(this).val() == "1009" || $(this).val() == "1010" || $(this).val() == "1011") {
            $("#Cafeteria").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#Cafeteria").hide();
        }

        if ($(this).val() == "1010" || $(this).val() == "1011" || $(this).val() == "1024" || $(this).val() == "1025") {
            $("#IsRoadFacing").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#IsRoadFacing").hide();
        }

        if ($(this).val() == "1011") {
            $("#PShowroom").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#PShowroom").hide();
        }

        if ($(this).val() == "1010" || $(this).val() == "1011") {
            $("#CornerShop").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#CornerShop").hide();
        }

        if ($(this).val() == "1001" || $(this).val() == "1012" || $(this).val() == "1014" || $(this).val() == "1016" || $(this).val() == "1017") {
            $("#BoundryWall").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#BoundryWall").hide();
        }

        if ($(this).val() == "1019") {
            $("#AppleTrees").show();
            $('#PropertyInfo').removeClass('hidden').addClass('show');
        } else {
            $("#AppleTrees").hide();
        }

    });
});

// Auto Select Options On Edit Property
$(function() {
    if ($('#PropertyType').val() == "1001" || $('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1012" || $('#PropertyType').val() == "1014" || $('#PropertyType').val() == "1016") {
        $("#MapPassed").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#MapPassed").hide();
    }

    if ($('#PropertyType').val() == "1001" || $('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1012" || $('#PropertyType').val() == "1013" || $('#PropertyType').val() == "1014" || $('#PropertyType').val() == "1016" || $('#PropertyType').val() == "1017" || $('#PropertyType').val() == "1018") {
        $("#OpenSides").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#OpenSides").hide();
    }

    if ($('#PropertyType').val() == "1001" || $('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1012" || $('#PropertyType').val() == "1013" || $('#PropertyType').val() == "1014" || $('#PropertyType').val() == "1016" || $('#PropertyType').val() == "1017" || $('#PropertyType').val() == "1018") {
        $("#WidthRoadFacing").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#WidthRoadFacing").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1018" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#Bedrooms").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#Bedrooms").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1007" || $('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1011" || $('#PropertyType').val() == "1018" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#Bathrooms").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#Bathrooms").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1007" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#Balconies").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#Balconies").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1007" || $('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011" || $('#PropertyType').val() == "1013" || $('#PropertyType').val() == "1018" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#FurnishStatus").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#FurnishStatus").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1007" || $('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011" || $('#PropertyType').val() == "1013" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#FloorNo").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#FloorNo").hide();
    }

    if ($('#PropertyType').val() == "1002" || $('#PropertyType').val() == "1003" || $('#PropertyType').val() == "1004" || $('#PropertyType').val() == "1005" || $('#PropertyType').val() == "1006" || $('#PropertyType').val() == "1007" || $('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011" || $('#PropertyType').val() == "1015" || $('#PropertyType').val() == "1018" || $('#PropertyType').val() == "1013") {
        $("#TotalFloor").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#TotalFloor").hide();
    }

    if ($('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1010") {
        $("#PWashroom").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#PWashroom").hide();
    }

    if ($('#PropertyType').val() == "1008" || $('#PropertyType').val() == "1009" || $('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011") {
        $("#Cafeteria").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#Cafeteria").hide();
    }

    if ($('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011" || $('#PropertyType').val() == "1024" || $('#PropertyType').val() == "1025") {
        $("#IsRoadFacing").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#IsRoadFacing").hide();
    }

    if ($('#PropertyType').val() == "1011") {
        $("#PShowroom").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#PShowroom").hide();
    }

    if ($('#PropertyType').val() == "1010" || $('#PropertyType').val() == "1011") {
        $("#CornerShop").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#CornerShop").hide();
    }

    if ($('#PropertyType').val() == "1001" || $('#PropertyType').val() == "1012" || $('#PropertyType').val() == "1014" || $('#PropertyType').val() == "1016" || $('#PropertyType').val() == "1017") {
        $("#BoundryWall").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#BoundryWall").hide();
    }

    if ($('#PropertyType').val() == "1019") {
        $("#AppleTrees").show();
        $('#PropertyInfo').removeClass('hidden').addClass('show');
    } else {
        $("#AppleTrees").hide();
    }

});

// Country, State, City Ajax Fetch
$('#country').change(function() {
    var countryID = $(this).val();
    var _token = $('input[name="_token"]').val();
    if (countryID) {
        $.ajax({
            type: "get",
            url: "get-state-list?country_id=" + countryID,
            data: { _token: _token },
            success: function(res) {
                if (res) {
                    $("#state").empty();
                    $("#state").append('<option>Select State</option>');
                    $.each(res, function(key, value) {
                        $("#state").append('<option value="' + key + '">' + value + '</option>');
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
                    $("#city").append('<option>Select City</option>');
                    $.each(res, function(key, value) {
                        $("#city").append('<option value="' + key + '">' + value + '</option>');
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

// Get State List on Country Select on property Edit Page
$('#country_pedit').change(function() {
    var countryID = $(this).val();
    var p_id = $('#p_id').val();
    var _token = $('input[name="_token"]').val();
    if (countryID) {
        $.ajax({
            type: "get",
            url: "/admin/property/" + p_id + "/edit/get-state-list?country_id=" + countryID,
            data: { _token: _token },
            success: function(res) {
                if (res) {
                    $("#state_pedit").empty();
                    $("#state_pedit").append('<option>Select State</option>');
                    $.each(res, function(key, value) {
                        $("#state_pedit").append('<option value="' + key + '">' + value + '</option>');
                    });
                } else {
                    $("#state_pedit").empty();
                }
            }
        });
    } else {
        $("#state_pedit").empty();
        $("#city_pedit").empty();
    }
});

// On Property Edit Get City List According to state
$('#state_pedit').on('change', function() {
    var stateID = $(this).val();
    var p_id = $('#p_id').val();
    if (stateID) {
        $.ajax({
            type: "GET",
            url: "/admin/property/" + p_id + "/edit/get-city-list?state_id=" + stateID,
            success: function(res) {
                if (res) {
                    $("#city_pedit").empty();
                    $("#city_pedit").append('<option>Select City</option>');
                    $.each(res, function(key, value) {
                        $("#city_pedit").append('<option value="' + key + '">' + value + '</option>');
                    });

                } else {
                    $("#city_pedit").empty();
                }
            }
        });
    } else {
        $("#city_pedit").empty();
    }
});


// Get State List on Country Select on property Edit Page
$('#country_CMSedit').change(function() {
    var countryID = $(this).val();
    var p_id = $('#PageID').val();
    var _token = $('input[name="_token"]').val();
    if (countryID) {
        $.ajax({
            type: "get",
            url: "/admin/page/" + p_id + "/edit/get-state-list?country_id=" + countryID,
            data: { _token: _token },
            success: function(res) {
                if (res) {
                    $("#state_CMSedit").empty();
                    $("#state_CMSedit").append('<option>Select State</option>');
                    $.each(res, function(key, value) {
                        $("#state_CMSedit").append('<option value="' + key + '">' + value + '</option>');
                    });
                } else {
                    $("#state_CMSedit").empty();
                }
            }
        });
    } else {
        $("#state_CMSedit").empty();
        $("#city_CMSedit").empty();
    }
});

// On Page Edit Get City List According to state
$('#state_CMSedit').on('change', function() {
    var stateID = $(this).val();
    var p_id = $('#PageID').val();
    if (stateID) {
        $.ajax({
            type: "GET",
            url: "/admin/page/" + p_id + "/edit/get-city-list?state_id=" + stateID,
            success: function(res) {
                if (res) {
                    $("#city_CMSedit").empty();
                    $("#city_CMSedit").append('<option>Select City</option>');
                    $.each(res, function(key, value) {
                        $("#city_CMSedit").append('<option value="' + key + '">' + value + '</option>');
                    });

                } else {
                    $("#city_CMSedit").empty();
                }
            }
        });
    } else {
        $("#city_CMSedit").empty();
    }
});


// Multiple Property Image upload by admin or user
var abc = 0; // Declaring and defining global increment variable.
$(document).ready(function() {
    $('#add_more').click(function() {
        $('.add_image').before($("<div/>", {
            id: 'filediv'
        }).fadeIn('slow').append($("<input/>", {
            name: 'file[]',
            type: 'file',
            id: 'file'
        }).trigger('click'), ));
    });

    // Following function will executes on change event of file input to select different file.
    $('body').on('change', '#file', function() {
        if (this.files && this.files[0]) {
            abc += 1; // Incrementing global variable by 1.
            var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            $(this).hide();
            $("#abcd" + abc).append($("<i></i>", {
                id: 'close',
                alt: 'delete',
                class: 'fa fa-close'
            }).click(function() {
                $(this).parent().parent().remove();
            }));
        }
    });
    // To Preview Image
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };
    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name) {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});

// // Hide all but Show after select any option from Property type
// $("#PropertyType").change(function() {
//     if ($(this).val() == 'no') {
//         $("#PropertyInfo").hide();
//     } else {
//         $("#PropertyInfo").show();
//     }
// });

// Show add builder on add new select
$("#NewBuilderName").change(function() {
    if ($(this).val() == 'addNewBuilder') {
        $("#AddBuilderData").show();
        $('#AddBuilderData').removeClass('hidden').addClass('show');
    } else {
        $("#AddBuilderData").hide();
    }
    if ($(this).val() != 'addNewBuilder') {
        $("#AddBuilderData").hide();
        $('#AddBuilderData').removeClass('show').addClass('hidden');
    }
});

// Show add Agent on add new select
$("#NewAgentName").change(function() {
    if ($(this).val() == 'addNewAgent') {
        $("#AddBuilderData").show();
        $('#AddBuilderData').removeClass('hidden').addClass('show');
    } else {
        $("#AddBuilderData").hide();
    }
    if ($(this).val() != 'addNewAgent') {
        $("#AddBuilderData").hide();
        $('#AddBuilderData').removeClass('show').addClass('hidden');
    }
});

// Access Datatables
$(function() {
    $('#allusers-table').DataTable();
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
});

// Select2, Datepicker, Colorpicker function
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
        //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
    $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        })

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
        //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })
});

// TinyMCE Text Editor for Description
var editor_config = {
    height: 250,
    // width: 750,
    path_absolute: "/",
    selector: "textarea.my-editor",
    branding: false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback: function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no"
        });
    }
};

tinymce.init(editor_config);

// Onclick Password Generate
var Password = {

    _pattern: /[a-zA-Z0-9_\-\+\.]/,

    _getRandomByte: function() {
        if (window.crypto && window.crypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    },

    generate: function(length) {
        return Array.apply(null, { 'length': length })
            .map(function() {
                var result;
                while (true) {
                    result = String.fromCharCode(this._getRandomByte());
                    if (this._pattern.test(result)) {
                        return result;
                    }
                }
            }, this)
            .join('');
    }
};


// Property Add by Admin Validations
$(document).ready(function() {
    $('#AddPropertyAdmin').click(function(e) {
        var isValid = true;
        // Property Name Validation
        $('#property_name').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_name').html(
                    '<label class="text-danger">Property Name can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        // Property Type Validation
        $('#PropertyType').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_type').html(
                    '<label class="text-danger">Property Type can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        // Property (Buy, Sale, Rent) Validation
        $('#property_for').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_for').html(
                    '<label class="text-danger">This field can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        // Property Description validation
        // $('#descriptions').each(function() {
        //     if ($.trim($(this).val()) == '') {
        //         isValid = false;
        //         $(this).css({
        //             "border": "1px solid red",
        //             "background": "#FFCECE"
        //         });
        //         $('#error_property_description').html(
        //             '<label class="text-danger">Description can\'t be empty!</label>');
        //         $('#error_msg_btn').html(
        //                 '<label class="text-danger">Fill the Mendatory fields!</label>');
        //     } else {
        //         $(this).css({
        //             "border": "",
        //             "background": ""
        //         });
        //     }
        // });
        // Country Field Validation
        $('#country').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_country').html(
                    '<label class="text-danger">Country field can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        // State Field Validation
        $('#state').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_state').html(
                    '<label class="text-danger">State field can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        // City Field Validation
        $('#city').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                $('#error_property_city').html(
                    '<label class="text-danger">City field can\'t be empty!</label>');
                $('#error_msg_btn').html(
                    '<label class="text-danger">Fill the Mendatory fields!</label>');
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        if (isValid == false) {
            e.preventDefault();
        }
    });
});