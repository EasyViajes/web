
<!DOCTYPE html>
<html lang="en">

<head>

    <title>EasyViajes | Checkout Pasaje</title>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<!-- Se llama al metodo onReady del js main -->

<body onload="onReady()">
    <?php include('navigation/navbar.php');?>
    <section class="ftco-section ftco-no-pb contact-section mb-4">
        <div class="container">
            <div class="row d-flex contact-info">
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <h3 class="mb-2">ORIGEN</h3>
                        <p>ejem santiago</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <h3 class="mb-2">Destino</h3>
                        <p><a href=""> Universidad de Chile</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-clock-o"></span>
                        </div>
                        <h3 class="mb-2">Hora</h3>
                        <p><a href="">9:30 am</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <h3 class="mb-2">Fecha</h3>
                        <p><a href="#">10/20/2022</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section ftco-no-pt">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form method="post" action="detalle_venta.php" class="bg-light p-5 contact-form">
                        <div class="form-group">
                            <input placeholder="Nombre" id="inp_name" type="text" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <input placeholder="Apellidos" id="inp_first_name" type="text" class="form-control"
                                required>

                        </div>
                        <div class="form-group">
                            <input placeholder="Correo" id="inp_email" type="email" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <input placeholder="Celular" id="inp_celular" type="number" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <input type="submit" value="Comprar" class="btn btn-primary py-3 px-5"
                                onclick="comprarBoleto()">
                        </div>
                    </form>

                </div>

                <div class="col-md-6 d-flex">
                    <div id="" class="bg-white">
                        <div class="col s12 m12 l12 center-align">
                            <div class="col l1 m2 hide-on-small-only"></div>
                            <!-- div para mostrar los asientos del autobus -->
                            <div class="col s12 l10 m8">
                                <div class="collection" id="_detatail_bus"></div>
                            </div>
                            <!-- -->
                            <div class="col l1 m2 hide-on-small-only"></div>
                        </div>

                        <div class="col s12 m12 l12 center-align">
                            <div class="col l1 m2 hide-on-small-only"></div>
                            <!-- div para mostrar los asientos del autobus -->
                            <div class="col s12 l10 m8" id="_autobus"></div>
                            <!-- -->
                            <div class="col l1 m2 hide-on-small-only"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="cho-container"></div>

    <!-- footer -->


    <?php include('navigation/footer.php');?>


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="public/js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="public/js/materialize.js"></script>
    <script type="text/javascript" src="public/js/faker.js"></script>
    <script type="text/javascript" src="public/js/init.js"></script>
    <script type="text/javascript" src="controllers/main.js"></script>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>

</html>