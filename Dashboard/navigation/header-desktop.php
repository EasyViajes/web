<?php
session_start();

# load data
$name = $_SESSION['nombre'];
$mail = $_SESSION['mail'];
?>

<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header" action="" method="POST">
                </div>
                <div class="header-button">
                    <div class="noti-wrap">
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"><?php echo $name?></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="images/icon/avatar-01.jpg" alt="capybara" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                        <a href="#"><?php echo $name?></a>
                                        </h5>
                                        <span class="email"><?php echo $mail?></span>
                                    </div>
                                </div>

                                <div class="account-dropdown__footer">
                                    <a href="/security.php">
                                        <i class="zmdi zmdi-shield-security"></i>Seguridad
                                    </a>
                                </div>

                                <div class="account-dropdown__footer">
                                    <a href="/logout.php">
                                        <i class="zmdi zmdi-power"></i>Logout
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
