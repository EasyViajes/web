<!DOCTYPE html>
<html lang="en">

<head>
    <title>EasyViajes | Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

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

<body>
    <?php include('navigation/navbar.php');?>

    <div class="hero-wrap js-fullheight" style="background-image: url('images/inicio.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="">EasyViajes</span>
                    <h1 class="mb-4">Encuentra tu ruta favorita</h1>
                    <p class="caps">Viaja en las distintas rutas de santiago con los colectivos colaboradores.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Barra de navegacion de busquedad de pasaje -->
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ftco-search d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                        href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                                        aria-selected="true">Comprar Boletos</a>
                                    <a class="nav-link" id="v-pills-2-tab" href="/Anulacion/" role="tab"
                                        aria-controls="v-pills-2" aria-selected="false">Anulación de
                                        Boletos</a>
                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                        aria-labelledby="v-pills-nextgen-tab">
                                        <form action="/pasaje-lista.php" class="search-property-1">
                                            <div class="row no-gutters">
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4 border-0">
                                                        <label for="#">Origen</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <div class="form-field">
                                                                <select name="region-origen" id="regiones" class="form-control"
                                                                    required>
                                                                    <option value="0">---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label for="#">Destino</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <div class="form-field">
                                                                <select name="region-destino" id="regiones2" class="form-control"
                                                                    required>
                                                                    <option value="0">---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4 border-0">
                                                        <label for="#">&nbsp</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <div class="form-field">
                                                                <select name="comuna-origen" id="comunas" class="form-control"
                                                                    required>
                                                                    <option value='0'>---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label for="#">&nbsp</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <div class="form-field">
                                                                <select name="comuna-destino" id="comunas2" class="form-control"
                                                                    required>
                                                                    <option value='0'>---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="#">Día</label>
                                                        <div class="form-field">
                                                            <select name="dia" id="dia" class="form-control" required>
                                                                <option value="0">Seleccione dia</option>
                                                                <option value="Lunes">Lunes</option>
                                                                <option value="Martes">Martes</option>
                                                                <option value="Miercoles">Miercoles</option>
                                                                <option value="Jueves">Jueves</option>
                                                                <option value="Viernes">Viernes</option>
                                                                <option value="Sabado">Sabado</option>
                                                                <option value="Domingo">Domingo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md d-flex">
                                                    <div class="form-group d-flex w-100 border-0">
                                                        <div class="form-field w-100 align-items-center d-flex">
                                                            <input type="submit" value="Buscar"
                                                                class="align-self-stretch form-control btn btn-primary">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Fin barra de navegación de compra de pasajes-->

    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                    <div class="w-100">
                        <span class="">Bienvenidos a EasyViajes</span>
                        <h2 class="mb-4">Comprar tus boletos nunca fue tan fácil</h2>
                        <p> 1.Escoge la ruta de colectivo que más te acomede.</p>
                        <p> 2.Selecciona la fecha en que necesitas tu boleto.</p>
                        <p> 3.Prefiere una empresa de colectivo.</p>
                        <p> 4.Paga tu pasaje mediante WebPay.</p>

                        <p>Listo, en tan solo 4 pasos ya tienes tu boleto reservado para viajar en colectivo. No más
                            filas , Prefiere EasyViajes!</p>
                        <p><a href="#" class="btn btn-primary py-3 px-4">Comprar Boletos</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img"
                                style="background-image: url(images/services-3.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="flaticon-route"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Ruta</h3>
                                    <p>Abarcamos gran cantidad de rutas del Gran Santiago</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img"
                                style="background-image: url(images/services-2.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa-solid fa-calendar-days"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Fechas y horarios flexibles</h3>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-3 d-block img"
                                style="background-image: url(images/Colectivo1.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa-solid fa-taxi"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Colectivos</h3>
                                    <p>Empresas certificadas por la super Intendencia de Medios de Transportes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img"
                                style="background-image: url(images/mercado-pago.jpg);">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa-sharp fa-solid fa-credit-card"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Mercado pago</h3>
                                    <p>Metodo de pago sencillo y seguro.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section img ftco-select-destination" style="background-image: url(images/bg_3.jpg);">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="">Favoritas de nuestros Usuarios</span>
                    <h2 class="mb-4">Rutas</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-destination owl-carousel ftco-animate">
                        <div class="item">
                            <div class="project-destination">
                                <a href="#" class="img" style="background-image: url(images/Parque-Quinta.jpg);">
                                    <div class="text">
                                        <h3>Quinta Normal</h3>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="project-destination">
                                <a href="#" class="img" style="background-image: url(images/universidad.jpg);">
                                    <div class="text">
                                        <h3>Metro Universidad de Chile</h3>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="project-destination">
                                <a href="#" class="img" style="background-image: url(images/quilicura.jpg);">
                                    <div class="text">
                                        <h3>Quilicura</h3>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="project-destination">
                                <a href="#" class="img" style="background-image: url(images/moneda.jpg);">
                                    <div class="text">
                                        <h3>Moneda</h3>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="project-destination">
                                <a href="#" class="img" style="background-image: url(images/Santiago.jpg);">
                                    <div class="text">
                                        <h3>Santiago Centro</h3>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('navigation/footer.php');?>

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
    <script>
    const datePicker = document.getElementById("date-picker");

    datePicker.min = getDate();
    datePicker.max = getDate(14);

    // Borrowed from https://stackoverflow.com/a/29774197/7290573
    function getDate(days) {
        let date;

        if (days !== undefined) {
            date = new Date(Date.now() + days * 24 * 60 * 60 * 1000);
        } else {
            date = new Date();
        }

        const offset = date.getTimezoneOffset();

        date = new Date(date.getTime() - (offset * 60 * 1000));

        return date.toISOString().split("T")[0];
    }
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/main.js"></script>

</body>

</html>