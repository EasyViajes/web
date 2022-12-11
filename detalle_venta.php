<?php 

$id_ruta = $_POST['id'];
$id_empresa = $_POST['fk_empresa'];
$mail = $_POST['mail'];

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-6099928014111868-050500-996855036f00e109b015b401732e69c7-179064861');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls=array(
  //"success"=>"http://easyviajes.cl/venta-exitosa.php?id_ruta=$id_ruta&id_empresa=$id_empresa&mail=$mail&nombre=$nombre&apellido=$apellido",
  "success"=>"http://localhost:8080/venta-exitosa.php?id_ruta=$id_ruta&id_empresa=$id_empresa&mail=$mail",
);

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Pasaje';
$item->quantity = 1;
$item->unit_price = $_POST['precio'];
$preference->items = array($item);
$preference->save();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>EasyViajes</title>

    <!--SDK MercadoPago.js V2-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>


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

<body>
    <?php include('navigation/navbar.php');?>
    <!-- Incorporar nav-->
    <section class="ftco-section contact-section ftco-no-pt">
        <div class="container">
            <main style="margin: 25px">
                <div class="">
                    <div class="row1">
                        <div class="col s12 m6 l8 " id="form_pago" style="padding: 15px;">
                            <!-- Formulario detalle -->
                            <section class="ftco-section ftco-no-pb contact-section mb-4">
                                <div class="container " id="pago">
                                    <div class="row d-flex contact-info">
                                        <div class="col-md-3 d-flex">
                                            <div class="align-self-stretch box p-4 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-map-marker"></span>
                                                </div>
                                                <h3 class="mb-2">ORIGEN</h3>
                                                <p><?php echo $_POST['direccion_origen']?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex">
                                            <div class="align-self-stretch box p-4 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-map-marker"></span>
                                                </div>
                                                <h3 class="mb-2">Destino</h3>
                                                <p><?php echo $_POST['direccion_destino']?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex">
                                            <div class="align-self-stretch box p-4 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-clock-o"></span>
                                                </div>
                                                <h3 class="mb-2">Hora</h3>
                                                <p><?php echo $_POST['hora_salida']?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex">
                                            <div class="align-self-stretch box p-4 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <h3 class="mb-2">Fecha</h3>
                                                <p><a href="#">11/24/2022</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <div class="mb-2">
                                <label for="disabledTextInput" class="form-label">Nombre</label>
                                <input type="text" id="disabledTextInput" value="<?php echo $_POST['nombre']?>" class="form-control"
                                    placeholder="Disabled input" disabled>
                            </div>
                            <div class="mb-2">
                                <label for="disabledTextInput" class="form-label">Apellido</label>
                                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_POST['apellido']?>"
                                    placeholder="Disabled input" disabled>
                            </div>
                            <div class="mb-2">
                                <label for="disabledTextInput" class="form-label">Email</label>
                                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_POST['mail']?>"
                                    placeholder="Disabled input" disabled>
                            </div>
                            <div class="mb-2" id="boton_pago">
                                <label for="disabledTextInput" class="form-label">Precio</label>
                                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_POST['precio']?>"
                                    placeholder="Disabled input" disabled>
                            </div>


                            <script>
                            const mp = new MercadoPago('TEST-2fb2cd2d-611d-4e31-a277-a0c4b89005cb', {
                                locale: 'es-CL'
                            });

                            mp.checkout({
                                preference: {
                                    id: '<?php echo $preference->id ?>'
                                },
                                render: {
                                    container: '#boton_pago',
                                    label: 'Pagar con Mercado Pago',
                                }
                            });
                            </script>
                        </div>
    </section>
    <!-- footer -->
    <?php include('navigation/footer.php');?>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>


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
    </div>
    </div>
    </div>
    </main>

</body>

</html>
