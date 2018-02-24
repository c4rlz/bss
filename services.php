<?php include "partials/head.html";
      include "partials/navbar.php"
?>
</header>
<div class="container-fluid">
  <section class="row">
    <article class="col-md-8">
      <div class="service-cover">
        <img class="service-img img-responsive" src="img/index-hero.jpg" alt="an image of work that we have done">
      </div>
    </article>
    <article class="col-md-4">
      <div class="page-descript">
        <h1 class='heading'>A Multi-Disciplinary Design Studio</h1>
          <p class='italic bold'>We specialize in creating beautiful and functional designs
          for the restaurant and bar industry. We know the importance of
          finding and communicating the uniqueness of each of our client’s
          brands.
        </p>
      </div>
    </article>
  </section>
<!-- ADD THIS CLASS SO THAT THE NAV PUSHES CONTENT WHEN OPENED-->
<!-- </div> -->
<!-- <div class="container"> -->
<div id='main'>
  <main class='service-content'>
        <!--SERVICES OFFERED -->
        <!-- GRAPHIC DESIGN -->
        <div class="row">
          <section class="service">
            <article class="col-xs-12 col-md-3 col-md-offset-1 text-right">
              <h2 class="heading">Graphic Design</h2>
              <p class="italic">Logos - Website Design - Decals</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </article>
            <article class="col-md-7 col-xs-12">
              <img class="service-icon img-responsive center-block" alt="an image of work that we have done" src="img/saigon-kitchen-logo.jpg">
            </article>
          </section>
        </div>
        <hr class="styled">
        <div class="row">
          <section class="service">
            <article class="col-md-7">
                <img class="service-icon img-responsive center-block" alt="an image of work that we have done" src="img/pizza-menu.jpg">
            </article>
            <article class="col-md-3">
              <h2 class="heading">Print Design</h2>
              <p class="italic">Menus - Business Cards - Advertisements</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </article>
          </section>
        </div>
        <hr class="styled">
          <!-- BRANDING & STRATEGY -->
            <div class="row">
              <section class="service">
                <article class="col-md-3 col-md-offset-1 text-right">
                  <h2 class="heading">Branding & Strategy</h2>
                  <p class="italic">Social Campaigns - Uniforms - Rebranding</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </article>
                <article class="col-md-6 col-md-offset-1">
                  <img class="img-responsive center-block" alt="an image of work that we have done" src="img/restaurant-branding.jpg">
                </article>
              </section>
            </div>
            <hr class="styled">
          <!-- INTERIOR DESIGN -->
          <div class="row">
          <section class="service">
            <article class="col-md-6 col-md-offset-1">
                <img class="img-responsive center-block" alt="an image of work that we have done" src="img/shabumaru-interior-design.jpg">
            </article>
            <article class="col-md-3 col-md-offset-1">
              <h2 class="heading">Interior Design</h2>
              <p class="italic">Signage - Conceptualization - Fungshui - Blueprints</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </article>
          </section>
        </div>
      </main>
     <section class="text-center">
          <h2>We are Committed To Creating
          Beautiful<br>  and Functional Designs</h2>
          <div class="btn-group" role="group" aria-label="...">
            <a class="btn btn-lg btn-primary" href="rates.php">Request A Quote</a>
            <a class="btn btn-lg btn-default" href="contact.php">Contact Us</a>
          </div>
        </section>
    </div>
  </div>
<?php include "partials/footer.php" ?>
