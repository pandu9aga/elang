<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/sucsessbox.css" rel="stylesheet"/>
		<link href="themes/css/animnotif.css" rel="stylesheet"/>
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
		<script src="js/material.min.js"></script>
		<link href="themes/css/material-icon.css" rel="stylesheet">
		<link rel="stylesheet" href="themes/css/application.min.css">


		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="themes/js/respond.min.js"></script>
		<![endif]-->
	</head>
   <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<a href="index.html" class="logo pull-left"><img width="200px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
				</div>
				<nav id="menu" class="pull-right">
						<ul>
							<li>
								<a>
									<div class="caption" ><center>CASH</center></div>
										<span class="mdl-chip mdl-chip--contact">
			                <span class="mdl-chip__contact color--orange">RP</span>
			                <span class="mdl-chip__text">512.000.000</span>
	                  </span>
								</a>
							</li>
							<li>
								<a>
									<div class="material-icons mdl-badge mdl-badge--overlap" data-badge="3">notifications_none</div>
									<div class="caption" >notifikasi</div>
								</a>
            					<!-- Notifications dropdown-->
            		<ul class="span3">
									<li>
										<a href="./products.html"><img width="27px" height="20px" src="succes.png" class="site_logo" alt="">Anda Menang Lelang Ikan Tuna 60 KG</a>
									</li>
									<li>
										<a href="./products.html"><img width="25px" height="20px" src="error.png" class="site_logo" alt="">Anda Kalah Lelang Ikan Tongkol 30 KG</a>
									</li>
									<li>
										<a href="./products.html"><img width="27px" height="20px" src="succes.png" class="site_logo" alt="">Anda Menang Lelang Ikan Kerapu 25 KG</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="./products.html"><i class="material-icons">account_box</i>
									<div class="caption" >PROFILE</div>
								</a>
							</li>
							<li>
								<a href="./products.html"><i class="material-icons">add_shopping_cart</i>
									<div class="caption" >CART</div>
								</a>
							</li>
							<li>
								<a><i class="material-icons">account_balance_wallet</i>
									<div class="caption" >TOPUP</div>
								</a>
								<ul>
									<li>
										<a href="./products.html"><img width="27px" height="20px" src="dollar.png" class="site_logo" alt="">Topup</a>
									</li>
									<li>
										<a href="./products.html"><img width="25px" height="20px" src="clock.png" class="site_logo" alt="">Cart Topup</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="./products.html"><i class="material-icons">exit_to_app</i>
									<div class="caption" >LOGOUT</div>
								</a>
							</li>
						</ul>
					</nav>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">

				</div>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
					  <h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
						<table class="table table-striped">
							<thead>
								<tr>
									<th></th>
									<th>Produk</th>
									<th>Nama </th>
									<th>Waktu Habis Lelang</th>
									<th>Total</th>
									<th><center>Status</center></th>
								</tr>
							</thead>

							<tbody>

								<tr>
									<td><h4>1.</h4></td>
									<td><a href="product_detail.html"><img alt="" height="200px" width="135px" src="themes/images/ikan/tuna.jfif"></a><br/></td>
									<td>Ikan Tuna 10 kg</td>
									<td>05.00 21/12/2019</td>
									<td>Rp. 200.000</td>
									<td>
										<div class="success-msg -msg">
									<div class="caption">Menunggu Hasil Lelang</div>
  									<em class="material-icons">done_all</em>
										<p class="buttons center">
									<button class="btn btn-inverse" type="submit" id="checkout">Bayar</button>
									</p>
										</div>
									</td>
								</tr>
								</tbody>
								<tbody>
								<tr>
									<td><h4>2.</h4></td>
									<td><a href="product_detail.html"><img alt="" height="200px" width="135px" src="themes/images/ikan/tongkol.jfif"></a><br/></td>
									<td>Ikan Tongkol 15 kg</td>
									<td>05.30 21/11/2019</td>
									<td>Rp. 100.000</td>
									<td>
									<div class="warning-msg">
									<div class="caption">Menunggu Hasil Lelang</div>
  									<em class="material-icons">watch_later</em>

									</div>
									</td>

								</tr>
							</tbody>
							<tbody>
								<tr>
									<td><h4>3.</h4></td>
									<td><a href="product_detail.html"><img alt="" height="200px" width="135px" src="themes/images/ikan/salmon.jpg"></a><br/></td>
									<td>Ikan Tenggiri 20 kg</td>
									<td>04.00 19/11/2019</td>
									<td>Rp. 300.000</td>
									<td>
										<div class="error-msg">
									<div class="caption">Anda Kalah Lelang</div>
  									<em class="material-icons">block</em>

									</div>
									</td>


								</tr>
							</tbody>

						</table>
						<hr/>

					</div>
					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
								<li class="nav-header">JENIS IKAN</li>
								<li><a href="products.html">Ikan Tuna</a></li>
								<li><a href="products.html">Ikan Tengiri</a></li>
								<li><a href="products.html">Ikan Tongkol</a></li>
								<li><a href="products.html">Ikan Teri</a></li>
								<li><a href="products.html">Ikan Kakap</a></li>
							</ul>
							<br/>
							<ul class="nav nav-list below">
								<li class="nav-header">WAKTU HABIS</li>
								<li><a href="products.html">16.00 20/12/2019</a></li>
								<li><a href="products.html">05.00 21/12/2019</a></li>
								<li><a href="products.html">10.00 21/12/2019</a></li>
								<li><a href="products.html">14.00 21/12/2019</a></li>
							</ul>
						</div>
					</div>
				</div>

			</section>


			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.html">Homepage</a></li>

							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Topup History</a></li>

        		</ul>
					</div>
					<div class="span5">
						<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
						<p>Web penyedia pelelangan ikan pertama di indonesia</p>
						<br/>
					</div>
				</div>
			</section>
			<section id="copyright">

				<span>Copyright 2019 E_LANG corporation</span>
			</section>

		<script src="themes/js/common.js"></script>
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>
	</div>
    </body>
</html>
