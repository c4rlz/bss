$(function(){
  //navbar function get it to open whem the menu buttton is clicked and closed when x is clicked
  $(".menu-btn").click(function(){
    openNav();
  })
  $("#mySidenav").click(function(){
    closeNav();
  })
  function openNav() {
    $("#mySidenav").css({"width":"270px"});
    $("#main").css({"margin-right":"270px"});
    $('.menu-btn').hide();
    $('#portfolio').delay(200).fadeIn(500, "swing");
    $('#service-title').delay(300).fadeIn(500, "swing");
    $('#service-1').delay(400).fadeIn(500, "swing");
    $('#service-2').delay(500).fadeIn(500, "swing");
    $('#about-title').delay(600).fadeIn(500, "swing");
    $('#about-1').delay(700).fadeIn(500, "swing");
    $('#about-2').delay(800).fadeIn(500, "swing");
    $('#contact').delay(900).fadeIn(500, "swing");
  }
  function closeNav() {
    $("#mySidenav").css({"width":"0"});
    $("#main").css({"margin-right":"0"})
    $('.menu-btn').show();
  }
  //MAKE THIS INTO AN OBJECT
  function sliderObject(sou, cap, inf){
    this.imageSource = sou;
    this.caption = cap;
    this.information = inf;
  }
  var santos = new sliderObject('img/santos-restaurant.jpg', 'Santos Restaurant', 'Boxspring Studio helped Santos with the interior and exterior decoration of their establishment. We also created a new logo concept.');

  var tipsyParson = new sliderObject('img/tipsy-parson-window.jpg', 'Tipsy Parson', 'Tipsy Parson came to Boxspring Studio looking for a new window decal. We ended up helping Tipsy Parson with business strategy and marketing');

  var ciboBarra = new sliderObject('img/cibo-barra-img.jpg', 'Cibo Barra', 'Cibo Barra came to Boxspring Studio for a full redesign and rebrand. Killick boatswain haul wind bring a spring upon her cable topmast.');

  var sliderArray = [santos, tipsyParson, ciboBarra];
  var counter = 0;
  //NEED TO MAKE THIS ONLY ON HOMEPAGE

  function imageSlider(){
    var accentCol = "#4DA4B7";
    var lightPurple = "#F6F2FF";
    //change the image sources
    $('.spotlight-work').attr("src", sliderArray[counter]["imageSource"]);

    //change the text describing each image
    $('.workCaption').html("<h3 class='text-uppercase'>" + sliderArray[counter]["caption"]+"</h3>"+ "<p>" + sliderArray[counter]["information"] + "</p>");
    currentCircle = ".circle-"+counter;
    $(currentCircle).css({"background-color": accentCol});
    $('.circle').not(currentCircle).css({"background-color": lightPurple});
    counter += 1;
    if (counter > sliderArray.length - 1) {
      counter = 0;
    }
  }
  //FIND CURRENT PAGE
  var currentHref = $(location).attr("href").split('/').pop();
  var getRequestHrefArr = currentHref.split("?");

  //SET INTERVAL ON HOMEPAGE
  if(currentHref === "index.php" || currentHref === " "  ){
    setInterval(imageSlider, 3000);
  }


  var pageArray = ['services.php', 'portfolio.php', 'boxspring-team.php', 'about.php', 'portfolio-item.php', 'rates.php'];

  if(pageArray.indexOf(currentHref) > -1 ||    pageArray.indexOf(getRequestHrefArr[0]) > -1 ) {

    var deepPurple = "#2D262E";

    //change the menu icon and logo to darker colours
    $('.menu-btn .st0').css({"stroke":deepPurple, "fill" : deepPurple});
    $('.menu-btn .st1').css({"stroke":deepPurple, "fill" : deepPurple});

    var classArray = [".st1", ".st2", ".st3", ".st4", ".st4", ".st5", ".st6"];
    for (var i = 0; i < classArray.length; i += 1 ){
      $(classArray[i]).css({"stroke":deepPurple, "fill": deepPurple});
    }
  }
   //----------ADMIN DIRECTORY ------------//
  //DELETE BUTTON HAS BEEN PRESSED
  $('.delete-btn').click(function(){
    var id = $(this).attr('id');
    var link = $("#" + id).data('link');
    //confirm user would like to delete the post
    var confirmation = confirm("Are you sure you would like to delete this post?");
    if (confirmation){
      $("#" + id).attr("href", link);
    }
  })
  //ADDED MORE IMAGE SELECTORS LAST MINUTE --- WOULD CREATE A CLASS WITH DATA ATTR TO MAKE IT MORE..ROBUST!!
  $('#image-select').change(function(){
    var currentImageSource =  $('#image-select option:selected').val();
    var totalImageSource = "media/" + currentImageSource;
    $('#show-img').attr("src", totalImageSource);
  })
   $('#image1-select').change(function(){
    var currentImageSource =  $('#image1-select option:selected').val();
    var totalImageSource = "media/" + currentImageSource;
    $('#show-img1').attr("src", totalImageSource);
  })
    $('#image2-select').change(function(){
    var currentImageSource =  $('#image2-select option:selected').val();
    var totalImageSource = "media/" + currentImageSource;
    $('#show-img2').attr("src", totalImageSource);
  })

  if(getRequestHrefArr[0] === "cms.php" || getRequestHrefArr[0] === "logon.php"){
      $('input.form-control').css("color", "black");
  }
})
