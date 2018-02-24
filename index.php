<?php include "partials/head.html";
      include "partials/navbar.php"; ?>
</header>
<div id="main">
  <div class="container-fluid home-hero center-block">
    <div class="black-overlay">
    <div class="hero-text text-center light-font">
      <h1 id="hero-h1" class="large-heading bold">We Are Passionate</h1>
      <h4 class="medium-bold italic subhead"> about creating an unforgettable experience<br> within the restaurant and bar industry</h4>
      <a href="portfolio.php" class="btn btn-primary text-uppercase">View Portfolio</a>
    </div>
  </div>
  </div>
  <main>
    <section class="container">
      <article class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <h1 class="heading">A Comprehensive Skill Set</h1>
          <p class="medium-bold italic subhead">Our team has vast expertise within the restaurant and bar industry<br>
          We are able to meet all of your establishment's design and marketing needs</p>
        </div>
      </article>
      <!-- ICONS -->
      <div class="icon-container">
        <div class="row">
          <div class='icon-height'>
            <article class="col-md-15 col-sm-4 col-xs-6">
              <img class="center-block" src ="img/graphic-design-icon.svg" alt='Graphic Design Icon'>
              <h2 class="text-center text-uppercase"> Graphic Design </h2>
            </article>
          <article class ="col-md-15 col-sm-4 col-xs-6">
              <img class="center-block" src ="img/print-design-icon.svg" alt='Print Design Icon'>
              <h2 class="text-center text-uppercase"> Print Design </h2>
          </article>
          </div>
          <div class='icon-height'>
            <article class ="col-md-15 col-sm-4 col-xs-6">
                <img src ="img/interior-design-icon.svg" alt='Interior Design Icon'>
                <h2 class="text-center text-uppercase"> Interior Design </h2>
            </article>
            <article class ="col-md-15 col-sm-offset-2 col-sm-4 col-xs-6 center-block">
                <img src="img/brand-identity-icon.svg" alt='Brand Identity Icon'>
                <h2 class="text-center text-uppercase"> Brand Identity</h2>
            </article>
          </div>
          <article class ="col-md-15 col-sm-4 col-xs-6 col-xs-offset-3 center-block strategy-icon">
            <div class='icon-height'>
              <img src ="img/business-strategy.svg" alt='Business Strategy Icon'>
              <h2 class="fix-width-issue text-center text-uppercase">
                 Business Strategy</h2>
            </div>
          </article>
        </div>
      </div>
    </section> <!-- END ICON SECTION -->
    <section class="dark-section section-spacing">
      <div class="container">
        <h1 class="text-center heading bold light-font">Recent Success Stories</h1>
        <p class="medium-bold italic text-center subhead light-font"> We strive to help all of our clients reach their full potential</p>
        <div class="row">
          <div class="col-md-7">
            <article class="image-slider">
              <img class="spotlight-work img-responsive center-block" src="img/cibo-barra-img.jpg" alt='An Image of work we did with Cibo Barra'>
            </article>
          </div>
          <!-- CAPTION ON THE RIGHT SIDE OF THE IMAGE (FLEX MIDDLE), CHANGS WHEN IMAGE CHANGES -->
          <article class="col-md-5">
            <div class="workCaption text-center">
              <h3 class="text-uppercase">Cibo Barra</h3>
              <p> Cibo Barra came to Boxspring Studio for a full redesign and rebrand.
              Killick boatswain haul wind bring a spring upon her cable topmast.</p>
            </div>
            <a href='portfolio.php' class='btn btn-primary btn-block'> View Portfolio</a>
            <div class='text-center'>
              <div class='circle circle-2'></div><div class='circle circle-0'></div><div class='circle circle-1'></div>
            </div>
          </article>
        </div>
      </div>
    </section>
  </main>
</div>
<!-- FULL WIDTH FOOTER -->
<?php include "partials/footer.php" ?>
