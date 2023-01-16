<?= $this->extend('layouts\app') ?>
<?= $this->section('content') ?>
<!-- ======= Property Search Section ======= -->
<div class="click-closed"></div>
<!--/ Form Search Star /-->

<!-- End Property Search Section -->>

<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
  <div class="container">
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <!-- <a class="navbar-brand text-brand" href="index.html">Estate<span class="color-b">Agency</span></a>
 -->
    <img src="assets/img/logo.png" alt="" class="img-a img-fluid" style="width: 15%;">

    <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="#">Property</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="#">Contact</a>
        </li>
      </ul>
    </div>

  </div>
</nav><!-- End Header/Navbar -->

<main id="main">

  <!-- ======= Intro Single ======= -->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">Our Amazing Properties</h1>
            <span class="color-text-a">Grid Properties</span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Properties Grid
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section><!-- End Intro Single-->

  <!-- ======= Property Grid ======= -->
  <section class="property-grid grid">
    <div class="container">
      <div class="row">


        <div class="col-md-4 mb-2">
          <div class="form-group mt-3">
            <label class="pb-2" for="Type">Minimum Area</label>
            <input name="minArea" type="number" class="form-control form-control-a" placeholder="Minimum Area" id="minArea" min=0>
          </div>
        </div>

        <div class="col-md-4 mb-2">
          <div class="form-group mt-3">
            <label class="pb-2" for="Type">Maximum Area</label>
            <input name="maxArea" type="number" class="form-control form-control-a" placeholder="Area" id="maxArea" min=0>
          </div>
        </div>

        <div class="col-md-4 mb-2">
          <div class="form-group mt-3">
            <label class="pb-2" for="Type">Minimum Price</label>
            <input name="minPrice" type="number" class="form-control form-control-a" placeholder="Minimum Price" id="minPrice" min=0>
          </div>
        </div>

        <div class="col-md-4 mb-2">
          <div class="form-group mt-3">
            <label class="pb-2" for="Type">Maximum Price</label>
            <input name="maxPrice" type="number" class="form-control form-control-a" placeholder="Maximum Price" id="maxPrice" min=0>
          </div>
        </div>
        <div class="col-md-4">
          <button type="button" id="search" class="btn btn-b">Search</button>
        </div>



        <div class="col-sm-12">
          <div class="grid-option">
            <form>
              <select class="custom-select" id="sort">
                <option value=''>New</option>
                <option value="hprice">Highest price</option>
                <option value="lprice">Lowest price</option>
                <option value="larea">Largest area</option>
                <option value="sarea">Smallest area</option>
                
              </select>
            </form>
          </div>
        </div>
      </div>
      <div class="row property-data" id="property-data">

        <?php print view('property_data', $properties) ?>

      </div>

      <div class="ajax-load text-center" style="display:none">
        <p><img src="assets/img/loader.gif">Loading..</p>
      </div>

    </div>
  </section><!-- End Property Grid Single-->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<section class="section-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4">
        <div class="widget-a">
          <div class="w-header-a">
            <!-- <h3 class="w-title-a text-brand">EstateAgency</h3> -->
            <img src="assets/img/logo.png" alt="" class="img-a img-fluid" style="width: 50%;">
          </div>
          <div class="w-body-a">
            <p class="w-text-a color-text-a" style="padding-top: 30px;">
              With a lot 💛 of real estate & technology from Munich
            </p>
          </div>
          <div class="w-footer-a">
            <ul class="list-unstyled">
              <li class="color-a">
                <span class="color-text-a">Phone .</span> contact@example.com
              </li>
              <li class="color-a">
                <span class="color-text-a">Email .</span> +54 356 945234
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    var search = '';
    var page = 1;
    var allDataLoaded = false;

    let handlerCallback = function() {
      if ($(this).scrollTop() + $(this).height() >= $('.property-data').height()) {
        if (!allDataLoaded) {
          loadMoreData(page)
          page++;
        }

      }
    };

    $(window).scroll(handlerCallback);

    $("#sort").on("change", function() {
      $('#property-data').empty();
      allDataLoaded = false;
      loadMoreData(0);
      page = 1;
    });

    $("#search").on("click", function() {
      $('#property-data').empty();
      allDataLoaded = false;
      loadMoreData(0);
      page = 1;
    });

    function loadMoreData(page) {

      /** Search property */
      var minArea = $('#minArea').val();
      var maxArea = $('#maxArea').val();
      var minPrice = $('#minPrice').val();
      var maxPrice = $('#maxPrice').val();
      var sort = $('#sort').val();

      var url = '?page=' + page;

      if (minArea != '') {
        url += '&minArea=' + minArea;
      }
      if (maxArea != '') {
        url += '&maxArea=' + maxArea;
      }
      if (minPrice != '') {
        url += '&minPrice=' + minPrice;
      }
      if (maxPrice != '') {
        url += '&maxPrice=' + maxPrice;
      }
      if (sort != '') {
        url += '&sort=' + sort;
      }

      $.ajax({
          url: url,
          type: "get",
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(data) {
          console.log(data)
          if (!data) {
            allDataLoaded = true
            $('.ajax-load').html("No more records found");
            return;
          }
          $('.ajax-load').hide();
          $("#property-data").append(data);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          console.log(thrownError);
        });
    }


  });
</script>


<?= $this->endSection() ?>