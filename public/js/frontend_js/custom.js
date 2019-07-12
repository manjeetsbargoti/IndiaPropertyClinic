
var stickyHeaders = (function() {

  var $window = $(window),
      $stickies;

  var load = function(stickies) {

    if (typeof stickies === "object" && stickies instanceof jQuery && stickies.length > 0) {

      $stickies = stickies.each(function() {

        var $thisSticky = $(this).wrap();
  
        $thisSticky
            .data('originalPosition', $thisSticky.offset().top)
            .data('originalHeight', $thisSticky.outerHeight())
              // .parent()
              // .height($thisSticky.outerHeight()); 			  
      });

      $window.off("scroll.stickies").on("scroll.stickies", function() {
		  _whenScrolling();		
      });
    }
  };

  var _whenScrolling = function() {

    $stickies.each(function(i) {			

      var $thisSticky = $(this),
          $stickyPosition = $thisSticky.data('originalPosition');

      if ($stickyPosition <= $window.scrollTop()) {        
        
        var $nextSticky = $stickies.eq(),
            $nextStickyPosition = $nextSticky.data('originalPosition') - $thisSticky.data('originalHeight');

        $thisSticky.addClass("sticky");

        if ($nextSticky.length > 0 && $thisSticky.offset().top >= $nextStickyPosition) {

          $thisSticky.addClass("absolute").css("top", $nextStickyPosition);
        }

      } else {
        
        var $prevSticky = $stickies.eq(i - 1);

        $thisSticky.removeClass("sticky");

        if ($prevSticky.length > 0 && $window.scrollTop() <= $thisSticky.data('originalPosition') - $thisSticky.data('originalHeight')) {

          $prevSticky.removeClass("absolute").removeAttr("style");
        }
      }
    });
  };

  return {
    load: load
  };
})();

$(function() {
  stickyHeaders.load($(".followMeBar"));
});




// off canvas menu //
$(function() {
  $('nav#menu').mmenu();
});

  // SIDEBAR canvas menu END //


$('.product-slide').owlCarousel({
    items:1,
    loop:true,
    margin:0,
    autoplay:true,
    nav:true,
    dots:false,
    lazyLoad: true
});

$('.feauture-slide').owlCarousel({
  items:1,
  loop:true,
  margin:0,
  autoplay:true,
  nav:true,
  dots:false,
  autoWidth:true,
  lazyLoad: true
});


$('.services').owlCarousel({
  loop: true,
  margin: 10,
  items: 4,
  autoplay:false,
  dots:false,
  responsiveClass: true,
  animateIn: 'shake',
  animateOut: 'shake',
  Infinity:true,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    600: {
      items: 3,
      nav: false
    },
    992: {
      items: 4,
      nav: true,
      loop: false,
      margin: 20
    }
  }
});


$('.dealerscarousel').owlCarousel({
  loop: true,
  margin: 10,
  autoplay:true,
  dots:false,
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      nav: true
    },
    600: {
      items: 3,
      nav: false
    },
    992: {
      items: 6,
      nav: true,
      loop: false,
      margin: 10
    },
    1200: {
      items: 8,
      nav: true,
      loop: false,
      margin: 10
    }
  }
});

// filter menu //

$(document).ready(function(){
  $(".mobfilter_show").click(function(){
    $(".show_mobfilter").toggle(500);
  });
});



// product view slider //

// product view slider //

$(document).ready(function() {
  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: true,
    nav: true,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});


// smooth scroll target //
$("#rateing_revbtn").click(function() {
  $('html, body').animate({
      scrollTop: $("#rateing_rev").offset().top + -55
  }, 1000);
});


$('.inside_menu a').click(function( e ){  
  $('a.active').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
  var targetId = $(this).attr("href");
  var top = $(targetId).offset().top + -44;
  $('html, body').stop().animate({scrollTop: top }, 500);
});


$('.inside_menu2 a').click(function( e ){  
  $('a.active').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
  var targetId = $(this).attr("href");
  var top = $(targetId).offset().top + -130;
  $('html, body').stop().animate({scrollTop: top }, 500);
});

// dynamic rating //

$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this <i>" + ratingValue + " stars.</i>";
    }
    else {
        msg = "We will improve ourselves. You rated this <i>" + ratingValue + " stars. </i>";
    }
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}




// svg image to inline code //
$(document).ready(function() {
  $('img[src$=".svg"]').each(function() {
      var $img = jQuery(this);
      var imgURL = $img.attr('src');
      var attributes = $img.prop("attributes");

      $.get(imgURL, function(data) {
          // Get the SVG tag, ignore the rest
          var $svg = jQuery(data).find('svg');

          // Remove any invalid XML tags
          $svg = $svg.removeAttr('xmlns:a');

          // Loop through IMG attributes and apply on SVG
          $.each(attributes, function() {
              $svg.attr(this.name, this.value);
          });

          // Replace IMG with SVG
          $img.replaceWith($svg);
      }, 'xml');
  });
});



// tooltips //

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


// Alphabatic scroll //

$('#alphalist a').click(function( e ){  
  $('a.active').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
  var targetId = $(this).attr("href");
  var top = $(targetId).offset().top + -80;
  $('html, body').stop().animate({scrollTop: top }, 500);
});



// Dealers Slider //

$('.newproject_grid').owlCarousel({
  loop: true,
  margin: 10,
  items: 4,
  autoplay:true,
  dots:false,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    600: {
      items: 3,
      nav: false
    },
    992: {
      items: 4,
      nav: true,
      loop: false,
      margin: 20
    }
  }
})


//   Chart Js //

window.onload = function () {

  var options = {
    animationEnabled: true,  
    title:{
      text: "Price Trend In Projects"
    },
    axisX: {
      valueFormatString: "YYYY"
    },
    toolTip: {
      shared: true
    },
    legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
    },
    axisY: {
      title: "PRICE / SQ.FT.",
      prefix: "₹",
      includeZero: false
    },

    axisY2: {
      title: "Profit in USD",
      titleFontColor: "#C0504E",
      lineColor: "#ff0",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E",
      includeZero: false
    },


    data: [{
      yValueFormatString: "₹#,###",
      xValueFormatString: "YYYY",
      type: "spline",
      name: "Amrawati1",
      showInLegend: true,
      
      
      dataPoints: [
        { x: new Date(2009, 0), y: 1320 },
        { x: new Date(2010, 0), y: 1500 },
        { x: new Date(2011, 1), y: 1211 },
        { x: new Date(2012, 2), y: 1300 },
        { x: new Date(2013, 3), y: 1100 },
        { x: new Date(2014, 4), y: 2350 },
        { x: new Date(2015, 5), y: 2515 },
        { x: new Date(2016, 6), y: 1117 },
        { x: new Date(2017, 7), y: 2458 },
        { x: new Date(2018, 8), y: 2814 },
        { x: new Date(2019, 9), y: 3500 }
        
      ]
    },
    {
      type: "spline",
      name: "Amrawati2",
      showInLegend: true,
      dataPoints: [
        { x: new Date(2009, 0), y: 500 },
        { x: new Date(2010, 0), y: 1200 },
        { x: new Date(2011, 1), y: 1300 },
        { x: new Date(2012, 2), y: 1850 },
        { x: new Date(2013, 3), y: 2200 },
        { x: new Date(2014, 4), y: 2500 },
        { x: new Date(2015, 5), y: 1425 },
        { x: new Date(2016, 6), y: 3521 },
        { x: new Date(2017, 7), y: 2571 },
        { x: new Date(2018, 8), y: 2814 },
        { x: new Date(2019, 9), y: 3500 }
        
      ]
    },
    {
      type: "spline",
      name: "Amrawati3",
      showInLegend: true,
      dataPoints: [
        { x: new Date(2009, 0), y: 3000 },
        { x: new Date(2010, 0), y: 2300 },
        { x: new Date(2011, 1), y: 2211 },
        { x: new Date(2012, 2), y: 1850 },
        { x: new Date(2013, 3), y: 2200 },
        { x: new Date(2014, 4), y: 2500 },
        { x: new Date(2015, 5), y: 0 },
        { x: new Date(2016, 6), y: 3521 },
        { x: new Date(2017, 7), y: 2323 },
        { x: new Date(2018, 8), y: 2547 },
        { x: new Date(2019, 9), y: 1524 }
        
      ]
    }
  ]
  };
  $("#chartContainer").CanvasJSChart(options);

  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else {
      e.dataSeries.visible = true;
    }
    e.chart.render();
  }
  
  }


// feature products //

$('.feature-slide').owlCarousel({
  autoplay: true,
     items: 1,
     nav: false,
     loop: true,
     autoplayHoverPause: true,
     animateOut: 'slideOutUp',
     animateIn: 'slideInUp',
     autoplayTimeout: 5000,
});

//  vender form //

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("formtab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("formtab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("formtab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "0") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}




var abc = 0; // Declaring and defining global increment variable.
$(document).ready(function() {
    $('#add_more').click(function() {
        $('.add_image').append($("<li/>", {
            id: 'filediv'
        }).fadeIn('slow').append($("<input/>", {
            name: 'file[]',
            type: 'file',
            id: 'file',
            class: 'hiddeninput'
        }).trigger('click')));
        
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
                id: 'closebtns',
                alt: 'delete',
                class: 'fas fa-times-circle'
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

//  EMI Calculator //


$("#la").bind(
  "slider:changed", function (event, data) {				
    $("#la_value").html(data.value.toFixed(0)); 
    calculateEMI();
  }
);

$("#nm").bind(
  "slider:changed", function (event, data) {				
    $("#nm_value").html(data.value.toFixed(0)); 
    calculateEMI();
  }
);

$("#roi").bind(
  "slider:changed", function (event, data) {				
    $("#roi_value").html(data.value.toFixed(2)); 
    calculateEMI();
  }
);

function calculateEMI(){
  var loanAmount = $("#la_value").html();
  var numberOfMonths = $("#nm_value").html();
  var rateOfInterest = $("#roi_value").html();
  var monthlyInterestRatio = (rateOfInterest/100)/12;
  
  var top = Math.pow((1+monthlyInterestRatio),numberOfMonths);
  var bottom = top -1;
  var sp = top / bottom;
  var emi = ((loanAmount * monthlyInterestRatio) * sp);
  var full = numberOfMonths * emi;
  var interest = full - loanAmount;
  var int_pge =  (interest / full) * 100;
  $("#tbl_int_pge").html(int_pge.toFixed(2)+" %");
  //$("#tbl_loan_pge").html((100-int_pge.toFixed(2))+" %");
  
  var emi_str = emi.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var loanAmount_str = loanAmount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var full_str = full.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var int_str = interest.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  
  $("#emi").html(emi_str);
  $("#tbl_emi").html(emi_str);
  $("#tbl_la").html(loanAmount_str);
  $("#tbl_nm").html(numberOfMonths);
  $("#tbl_roi").html(rateOfInterest);
  $("#tbl_full").html(full_str);
  $("#tbl_int").html(int_str);
  var detailDesc = "<thead><tr class='success'><th>Payment No.</th><th>Begining Balance</th><th>EMI</th><th>Principal</th><th>Interest</th><th>Ending Balance</th></thead><tbody>";
  var bb=parseInt(loanAmount);
  var int_dd =0;var pre_dd=0;var end_dd=0;
  for (var j=1;j<=numberOfMonths;j++){
    int_dd = bb * ((rateOfInterest/100)/12);
    pre_dd = emi.toFixed(2) - int_dd.toFixed(2);
    end_dd = bb - pre_dd.toFixed(2);
    detailDesc += "<tr><td>"+j+"</td><td>"+bb.toFixed(2)+"</td><td>"+emi.toFixed(2)+"</td><td>"+pre_dd.toFixed(2)+"</td><td>"+int_dd.toFixed(2)+"</td><td>"+end_dd.toFixed(2)+"</td></tr>";
    bb = bb - pre_dd.toFixed(2);
  }
    detailDesc += "</tbody>";
  $("#illustrate").html(detailDesc);
   $('#container').highcharts({
   
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
      },
      title: {
        text: 'EMI Calculator'
      },
      tooltip: {
        //pointFormat: '{series.name}: <b>{point.value}%</b>'
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
          //	enabled: true,
            color: '#000000',
            connectorColor: '#000000',
            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
          }
        }
      },
      series: [{
        type: 'pie',
        name: 'Amount',
        data: [
          ['Loan',   eval(loanAmount)],
          ['Interest',       eval(interest.toFixed(2))]
        ]
      }]
    });			

}
calculateEMI();

// User Register Validation
$('#registerForm').validate({
  rules:{
    email: {
      required: true,
    },
    messages: {
      email: {
        required: "Please Enter Your Email",
      }
    }
  }
})







