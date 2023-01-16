<?php foreach ($properties as $property) { ?>
    <div class="col-md-4">
        <div class="card-box-a card-shadow">
            <div class="img-box-a">

                <img src="assets/property_images/<?= !empty($property['image']) ? $property['image'] : 'image2.jpg' ?>" alt="" class="img-a img-fluid">
            </div>
            <div class="card-overlay">
                <div class="card-overlay-a-content">
                    <div class="card-header-a">
                        <h2 class="card-title-a">
                            <a href="#"><?php echo $property['title']; ?></a>
                        </h2>

                    </div>
                    <div class="card-body-a">
                        <div class="price-box d-flex">
                            <span class="address"><?php echo $property['address']; ?></span>
                        </div>

                        <div class="price-box d-flex">
                            <span class="price-a">Price | € <?php echo $property['price']; ?></span>
                        </div>

                        <div class="price-box d-flex">
                            <span class="size">Area <?php echo $property['size']; ?> m<sup>2</sup></span>
                        </div>

                        <a href="#" class="link-a">Click here to view
                            <span class="bi bi-chevron-right"></span>
                        </a>
                    </div>
                    <div class="card-footer-a">
                        <ul class="card-info d-flex justify-content-around">
                            <li>
                                <h4 class="card-info-title">Beds</h4>
                                <span>2</span>
                            </li>
                            <li>
                                <h4 class="card-info-title">Baths</h4>
                                <span>4</span>
                            </li>
                            <li>
                                <h4 class="card-info-title">Garages</h4>
                                <span>1</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>