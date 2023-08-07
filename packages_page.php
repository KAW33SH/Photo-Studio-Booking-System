<?php
include 'session_check.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Packages Page</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/packages_page.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center">Select a Package</h2>
                <div class="dropdown-package">
                    <form action="#" method="POST">
                        <select class="form-control" name="package" id="packageSelect">
                            <option value="">Select Package</option>
                            <option value="package1">Package 1: Classic Portrait - LKR.2000</option>
                            <option value="package2">Package 2: Family Fun - LKR.2500</option>
                            <option value="package3">Package 3: Creative Concept - LKR.3000</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="reservation-button">
                    <a href="reservation_page.php">
                        <button class="btn" id="reservationBtn" disabled>Make a Reservation</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <section class="carousel" aria-label="Gallery">
                    <ol class="carousel__viewport">
                        <li id="carousel__slide1" tabindex="0" class="carousel__slide">
                            <div class="carousel__snapper">
                                <a href="#carousel__slide4" class="carousel__prev">Go to last slide</a>
                                <a href="#carousel__slide2" class="carousel__next">Go to next slide</a>
                                <img class="img" src="assets/images/carousel_img1.jpg" alt="Image 1">
                            </div>
                        </li>
                        <li id="carousel__slide2" tabindex="0" class="carousel__slide">
                            <div class="carousel__snapper"></div>
                            <a href="#carousel__slide1" class="carousel__prev">Go to previous slide</a>
                            <a href="#carousel__slide3" class="carousel__next">Go to next slide</a>
                            <img class="img" src="assets/images/carousel_img2.jpeg" alt="Image 1">
                        </li>
                        <li id="carousel__slide3" tabindex="0" class="carousel__slide">
                            <div class="carousel__snapper"></div>
                            <a href="#carousel__slide2" class="carousel__prev">Go to previous slide</a>
                            <a href="#carousel__slide4" class="carousel__next">Go to next slide</a>
                            <img class="img" src="assets/images/carousel_img3.jpg" alt="Image 3">
                        </li>
                        <li id="carousel__slide4" tabindex="0" class="carousel__slide">
                            <div class="carousel__snapper"></div>
                            <a href="#carousel__slide3" class="carousel__prev">Go to previous slide</a>
                            <a href="#carousel__slide1" class="carousel__next">Go to first slide</a>
                            <img class="img" src="assets/images/carousel_img4.jpg" alt="Image 4">
                        </li>
                    </ol>
                    <aside class="carousel__navigation">
                        <ol class="carousel__navigation-list">
                            <li class="carousel__navigation-item">
                                <a href="#carousel__slide1" class="carousel__navigation-button">Go to slide 1</a>
                            </li>
                            <li class="carousel__navigation-item">
                                <a href="#carousel__slide2" class="carousel__navigation-button">Go to slide 2</a>
                            </li>
                            <li class="carousel__navigation-item">
                                <a href="#carousel__slide3" class="carousel__navigation-button">Go to slide 3</a>
                            </li>
                            <li class="carousel__navigation-item">
                                <a href="#carousel__slide4" class="carousel__navigation-button">Go to slide 4</a>
                            </li>
                        </ol>
                    </aside>
                </section>
                <h1 class="demo">Demo Photos</h1>
                <p class="demo">This is a demo photo to showcase the quality of our photography.</p>
            </div>
            <div class="col-md-6">
                <div class="card package-details-card">
                    <div class="card-body">
                        <h5 class="card-title">Package Details</h5>
                        <div class="form-group">
                            <label for="location"><i class="fas fa-map-marker-alt"></i> Location:</label>
                            <select class="form-control" id="location" disabled>
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number-of-photos"><i class="fas fa-camera"></i> Number of Photos:</label>
                            <select class="form-control" id="number-of-photos" disabled>
                                <option value="5">5 photos</option>
                                <option value="10">10 photos</option>
                                <option value="15">15 photos</option>
                                <option value="20">20 photos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price" class="fa-dollar-sign"><i></i> Price:</label>

                            <p id="packagePrice">LKR.0</p>
                        </div>
                        <div class="form-group">
                            <label for="total-price"  class="fa-dollar-sign"><i></i>Additional Price:</label>

                            <p id="additionalPrice">LKR.0</p>
                        </div>
                        <div class="form-group">
                            <label for="total-price" class="total"><i class="fas fa-dollar-sign"></i>Total:</label>
                            <p id="totalPrice">LKR.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#packageSelect').change(function() {
                var selectedPackage = $('#packageSelect').val();
                var basePrice = 0;
                var additionalPrice = 0;

                if (selectedPackage === 'package1') {
                    basePrice = 2000;
                    $('#number-of-photos').val('5');
                } else if (selectedPackage === 'package2') {
                    basePrice = 2500;
                    $('#number-of-photos').val('5');
                } else if (selectedPackage === 'package3') {
                    basePrice = 3000;
                    $('#number-of-photos').val('5');
                }

                $('#packagePrice').text('LKR.' + basePrice);
                $('#additionalPrice').text('LKR.' + additionalPrice);
                $('#totalPrice').text('LKR.' + (basePrice + additionalPrice));

                if (selectedPackage !== '') {
                    $('#location').prop('disabled', false);
                    $('#number-of-photos').prop('disabled', false);
                    $('#reservationBtn').removeAttr('disabled');
                } else {
                    $('#location').prop('disabled', true);
                    $('#number-of-photos').prop('disabled', true);
                    $('#reservationBtn').attr('disabled', 'disabled');
                }
            });

            $('#number-of-persons, #number-of-photos').change(function() {
                var selectedPackage = $('#packageSelect').val();
                var basePrice = 0;
                var additionalPrice = 0;
                var numberOfPersons = parseInt($('#number-of-persons').val());
                var numberOfPhotos = parseInt($('#number-of-photos').val());

                if (selectedPackage === 'package1') {
                    basePrice = 2000;
                } else if (selectedPackage === 'package2') {
                    basePrice = 2500;
                } else if (selectedPackage === 'package3') {
                    basePrice = 3000;
                }

                if (numberOfPhotos === 5) {
                    additionalPrice = 0;
                } else if (numberOfPhotos === 10) {
                    additionalPrice = 500;
                } else if (numberOfPhotos === 15) {
                    additionalPrice = 1000;
                } else if (numberOfPhotos === 20) {
                    additionalPrice = 1500;
                }

                var totalPrice = basePrice + additionalPrice;

                $('#additionalPrice').text('LKR.' + additionalPrice);
                $('#totalPrice').text('LKR.' + totalPrice);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var carouselItems = Array.from(document.querySelectorAll("#carousel .item"));
            var position = 1;

            // Radio buttons functionality
            var radioButtons = Array.from(document.querySelectorAll('.radio-buttons input'));
            var carouselItems = Array.from(document.querySelectorAll("#carousel .item"));
            var position = 1;
            var interval;

            function updateCarousel() {
                carouselItems.forEach(item => item.style.setProperty("--position", position));
            }

            function moveToNextImage() {
                position = (position % 5) + 1;
                updateCarousel();
                radioButtons[position - 1].checked = true;
            }

            function startCarousel() {
                interval = setInterval(moveToNextImage, 3000);
            }

            function stopCarousel() {
                clearInterval(interval);
            }

            radioButtons.forEach(function(radioButton, index) {
                radioButton.addEventListener('click', function() {
                    position = index + 1;
                    updateCarousel();
                });
            });

            startCarousel();
        });
    </script>
</body>

</html>