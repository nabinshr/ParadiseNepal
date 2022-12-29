<?php
require_once "header.php";
?>
<section id="slides" class="mb-10">
    <?php
$query = "SELECT * FROM `sliders` ORDER BY id DESC LIMIT 5";
$execute = mysqli_query($con, $query);
$data = mysqli_fetch_all($execute, MYSQLI_ASSOC);
if ($data != null) {
    ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            <?php
$index = 0;
    foreach ($data as $item) {
        ?>
            <div class="item <?=($index == 0) ? "active" : ""?>">
                <img src="<?=ASSET . "images/slider/" . $item["slider_image"]?>">
                <div class="carousel-caption">
                    <?=$item["caption"]?>
                </div>
            </div>
            <?php
$index++;
    }
    ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
}
?>
</section>

<div class="row">
    <div class="col-md-8">
        <section id="top-destination">
            <div class="panel panel-default br-0">
                <div class="panel-heading">
                    <span class="h4">
                        Top Destination Places
                    </span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="hovereffect">
                                <img class="img-responsive" src="img/chitwan1.jpg" alt="">
                                <div class="overlay">
                                    <h2>Chitwan National Park is a preserved area in the Terai Lowlands of
                                        south-central
                                        Nepal,
                                        known for its biodiversity. Its dense forests and grassy plains are home
                                        to rare
                                        mammals
                                        like one-horned rhinos and Bengal tigers.</h2>
                                    <a class="info" href="#">Chitwan</a>
                                </div>
                                <!--end overlay-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hovereffect">
                                <img class="img-responsive" src="img/chitwan1.jpg" alt="">
                                <div class="overlay">
                                    <h2>Chitwan National Park is a preserved area in the Terai Lowlands of
                                        south-central
                                        Nepal,
                                        known for its biodiversity. Its dense forests and grassy plains are home
                                        to rare
                                        mammals
                                        like one-horned rhinos and Bengal tigers.</h2>
                                    <a class="info" href="#">Chitwan</a>
                                </div>
                                <!--end overlay-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hovereffect">
                                <img class="img-responsive" src="img/chitwan1.jpg" alt="">
                                <div class="overlay">
                                    <h2>Chitwan National Park is a preserved area in the Terai Lowlands of
                                        south-central
                                        Nepal,
                                        known for its biodiversity. Its dense forests and grassy plains are home
                                        to rare
                                        mammals
                                        like one-horned rhinos and Bengal tigers.</h2>
                                    <a class="info" href="#">Chitwan</a>
                                </div>
                                <!--end overlay-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <section id="FeaturedTour">
            <div class="panel panel-default br-0">
                <div class="panel-heading">
                    <span class="h4">Featured tour of the Year</span>
                </div>
                <div class="panel-body">
                    <div class="content">

                        <div class="grid">
                            <?php
$query = "SELECT * FROM `packages` WHERE `Type` = '1' AND `Status` = '1' ORDER BY CreatedAt desc LIMIT 4";
$executeFeaturedTrip = mysqli_query($con, $query);
$featuredTrips = mysqli_fetch_all($executeFeaturedTrip, MYSQLI_ASSOC);
$row = mysqli_num_rows($executeFeaturedTrip);

if ($featuredTrips != null) {
    foreach ($featuredTrips as $featuredTrip) {
        ?>
                            <a href="<?=URL . "TourDetail.php?id=" . $featuredTrip["Id"]?>">
                                <figure class="effect-lily">
                                    <img src="<?=ASSET . "/images/slider/" . $featuredTrip['images']?>" alt="img12" />
                                    <figcaption>
                                        <div>
                                            <h2> <?=$featuredTrip['Name']?><span><?=$featuredTrip['Duration']?></span>
                                            </h2>
                                            <p><?=TrimText($featuredTrip['Description'])?></p>
                                        </div>

                                    </figcaption>
                                </figure>
                            </a>
                            <?php
                            if($row > 4){
                                ?>
                                <div class="clearfix"></div>
<div class="text-center">
<a href="" class="btn btn-primary">View All</a>
</div>
                                <?php
                            }
}
} else {
    ?>
                            <span>No Data Found</span>
                            <?php
}
?>
                        </div>
                        <!--end grid-->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4">
        <section id="packages">
            <div class="panel panel-default br-0">
                <div class="panel-heading">
                    <span class="h4">Popular Packages
                    </span>
                </div>
                <div class="panel-body">
                    <?php
$query = "SELECT * FROM `packages` WHERE `Type` = '2' AND `Status` = '1' ORDER BY CreatedAt desc LIMIT 10";
$executePopularTrip = mysqli_query($con, $query);
$popularTrips = mysqli_fetch_all($executePopularTrip, MYSQLI_ASSOC);
$row = mysqli_num_rows($executePopularTrip);

if ($popularTrips != null) {
    foreach ($popularTrips as $popularTrip) {
        ?>
                    <div class="popular">
                        <img src="<?=ASSET . "/images/slider/" . $popularTrip['images']?>">
                        <p><strong><?=$popularTrip['Name']?>(<?=$popularTrip['Duration']?>)</strong></p>
                        <p><?=TrimText($popularTrip['Description'])?></p>
                        <p class="text-right"><a href="<?=URL . "TourDetail.php?id=" . $popularTrip["Id"]?>" class="btn btn-xs btn-primary">View more</a></p>
                    </div>
                    <!--popular-->
                    <?php
if ($row > 10) {
?>
<div class="text-center">
<a href="" class="btn btn-primary btn-block">View All</a>
</div>
<?php
        }

    }
} else {
    ?>
                    <span>No Data Found</span>
                    <?php
}
?>
                </div>
            </div>
        </section>
    </div>
</div>
</div>

<div class="container">

    <div class="col-md-8">


        <!--<div class="destination">-->

        <!--end destination-->
        <!--</div>-->
        <!--destinaton end-->

    </div>
    <!--end col-md-8-->



    <div class="col-md-4">

        <!--package-->
    </div>
    <!--end col-md-4-->


    <div class="col-md-8">
        <div class="row">


            <!--end content-->
        </div>
        <!--end row-->
    </div>
    <!--end col-md-8-->
    <div class="frame">
        <iframe width="1140" height="650" src="https://www.youtube.com/embed/hoOGcgPig9c" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <!--end frame-->
</div>
<!--end container-->
<!-- Footer -->
<footer class="page-footer font-small unique-color-dark">

    <div style="background-color: #6351ce;">
        <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <h6 class="mb-0">Get connected with us on social networks!</h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-7 text-center text-md-right">

                    <!-- Facebook -->
                    <a class="fb-ic">
                        <i class="fab fa-facebook-f white-text mr-4"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fab fa-twitter white-text mr-4"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
                        <i class="fab fa-google-plus-g white-text mr-4"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic">
                        <i class="fab fa-linkedin-in white-text mr-4"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fab fa-instagram white-text"> </i>
                    </a>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                <!-- Content -->
                <h6 class="text-uppercase font-weight-bold">Company name</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                    consectetur
                    adipisicing elit.</p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Products</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="#!">MDBootstrap</a>
                </p>
                <p>
                    <a href="#!">MDWordPress</a>
                </p>
                <p>
                    <a href="#!">BrandFlow</a>
                </p>
                <p>
                    <a href="#!">Bootstrap Angular</a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Useful links</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="#!">Your Account</a>
                </p>
                <p>
                    <a href="#!">Become an Affiliate</a>
                </p>
                <p>
                    <a href="#!">Shipping Rates</a>
                </p>
                <p>
                    <a href="#!">Help</a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                <p>
                    <i class="fas fa-envelope mr-3"></i> info@example.com</p>
                <p>
                    <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                <p>
                    <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

<?php
require_once "footer.php";
?>