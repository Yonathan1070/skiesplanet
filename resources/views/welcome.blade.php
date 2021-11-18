<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>SkiesPlanet | Reservas</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
	<!-- Bootstrap-Core-CSS -->
	<link href="{{asset('assets/css/JiSlider.css')}}" rel="stylesheet">
	<!-- //banner-slider -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.css')}}">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,200,300,500,800,900" rel="stylesheet">
	<!-- //Web-Fonts -->
	<style>
		.logo{
			font-weight: 600;
			letter-spacing: 0.25em;
		}

		.idioma{
			position: absolute;
			right: 20px;
		}
	</style>

</head>

<body>
	<!-- header -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand logo" href="index.html">
				SKIES PLANET
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle" aria-controls="navbarNavAltMarkup"
			    aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse navbar-toggle idioma" id="navbarNavAltMarkup">
				<div class="top-info text-lg-right text-center mt-lg-0 mt-3">
					<ul class="list-unstyled">
						<li class="number-phone">
							<a class="request text-uppercase font-weight-bold text-white" href="#">IDIOMA</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- //header -->

	<!-- banner slider-->
	<div class="banner-silder">
		<div id="JiSlider" class="jislider">
			<div class="w3layouts-banner-top w3layouts-banner-top">
				<div class="bs-slider-overlay">
					<div class="container">
						<!-- Slide Text Layer -->
						<div class="w3l-slide-text">
							<h1 data-animation="animated zoomInRight">Elige Tu Cielo</h1>
							<h4 class="aos-init aos-animate" data-aos="fade-down">
								Selecciona la ubicación y la fecha de tu cielo y comprueba su disponibilidad.
							</h4>
							<a href="#services" class="button-style-blue" data-animation="animated fadeInDown" data-aos="fade-down">
								BUSCA TU CIELO
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //banner slider -->

	<!-- feedback -->
	<section class="news py-5" id="services">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center text-uppercase text-brand font-weight-bold mb-sm-5 mb-4">
				Tenemos tres opciones de cielos para ti
			</h3>
			<div class="owl-carousel owl-theme">
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							LOCAL
						</h4>
						<p>
							Certificado de titularidad del cielo, de una ciudad y a una hora y día específico.&nbsp;
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$10US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							NACIONAL
						</h4>
						<p>
							Certificado de titularidad del cielo de un país completo a una hora y día específico.
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$50US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							GLOBAL
						</h4>
						<p>
							Certificado de titularidad del cielo del mundo entero, a una hora y día específico.
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$500US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			<a href="#booking" class="button-style-blue-center" data-animation="animated fadeInDown" data-aos="fade-down">
				BUSCA TU CIELO
			</a>
		</div>
	</section>
	<!-- //feedback -->

	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			Reserva Ahora!
		</h3>
		<div class="row">
			<div class="col-md-6 main_grid_contact">
				<div class="form">
					<h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
						Certificado Digital de Titularidad del Cielo
					</h4>
					<p>
						Este certicado es un ejemplo, el certificado es diseñado por un artista digital y es único, ya que tu mismo cielo nadie más lo podrá tener
					</p>
					<br/>
					<div class="feedback-grids">
						<img src="{{asset('assets/images/certificado.jpg')}}" class="img-fluid"alt="">
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<div class="col-md-6 main_grid_contact bg-light">
				<div class="form">
					<h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
						Reserva de Reserva
					</h4>
					<form action="#" method="post">
						<div class="form-group">
							<label class="mb-2">Tipo de reserva</label>
							<select class="form-control" id="tipoId" name="tipoId">
								<option selected>Seleccione ------</option>
								<option value="1">Hora de Ciudad</option>
								<option value="2">Hora de País</option>
								<option value="3">Hora del Mundo</option>
							</select>
						</div>
						<div class="form-group">
							<label class="mb-2">País</label>
							<select class="form-control" id="paisId" name="paisId">
								<option selected>Seleccione ------</option>
							</select>
						</div>
						<div class="form-group">
							<label class="mb-2">Ciudad</label>
							<select class="form-control" id="ciudadId" name="ciudadId">
								<option selected>Seleccione ------</option>
							</select>
						</div>
						<div class="form-group">
							<label class="mb-2">Mes</label>
							<select class="form-control" id="mes" name="mes">
								<option selected>Seleccione ------</option>
							</select>
						</div>
						<div class="form-group">
							<label class="mb-2">Día</label>
							<select class="form-control" id="dia" name="dia">
								<option selected>Seleccione ------</option>
							</select>
						</div>
						<div class="input-group1">
							<input class="form-control" type="submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->

	<!-- middle section -->
	<div class="middle-w3l text-center py-5">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center text-uppercase text-blue font-weight-bold mb-sm-4 mb-3 mt-4">
				Importante
			</h3>
			<div class="w3l-slide-text" style="padding-top: 1em;">
				<h3>
					<p class="aos-init aos-animate" data-aos="fade-down">
						El precio es por una (1) hora específica. Ejemplo: De las 3 a las 4 pm.
					</p>
				</h3>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					Por supuesto que puedes comprar más de una hora, solo debes tener en cuenta que su precio incrementara de acuerdo al valor de cada hora escogida (ciudad, país o Mundo)
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					El cielo que compraste te pertenece de manera VITALICIA, es decir que cada año podrás ver, disfrutar y fotografiar tu propio cielo.
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					El certificado es diseñado por un artista digital y es único, ya que tu mismo cielo nadie más lo podrá tener
				</p>
			</div>
		</div>
	</div>
	<!-- //middle section -->

	<!-- copyright -->
	<div class="copy-right-w3ls py-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 w3ls-left-copy text-lg-left text-center">
					<p class="copy-right-grids text-white">
						&copy; Copyright SkiesPlanet. Todos los derechos reservados | Hecho con ❤ por 
						<a href="https://inkagenciad.com/" target="_blank">INK AGENCIA DIGITAL</a>
					</p>
				</div>
				<div class="col-lg-3 w3ls-left-copy text-lg-right text-center">
					<p class="text-white">
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- //copyright -->


	<!-- Js files -->
	<!-- JavaScript -->
	<script src="{{asset('assets/js/jquery-2.2.3.min.js')}}"></script>
	<!-- Default-JavaScript-File -->
	<script src="{{asset('assets/js/bootstrap.js')}}"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- navigation -->
	<!-- dropdown smooth -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //dropdown smooth -->
	<!-- fixed nav -->
	<script>
		$(window).scroll(function () {
			if ($(document).scrollTop() > 50) {
				$('nav').addClass('shrink');
			} else {
				$('nav').removeClass('shrink');
			}
		});
	</script>
	<!-- //fixed nav -->
	<!-- //navigation -->

	<!--banner-slider-->
	<script src="{{asset('assets/js/JiSlider.js')}}"></script>
	<script>
		$(window).load(function () {
			$('#JiSlider').JiSlider({
				color: '#fff',
				start: 3,
				reverse: true
			}).addClass('ff')
		})
	</script>
	<!-- //banner-slider -->

	<!-- carousel(for feedback) -->
	<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
	<script>
		$(document).ready(function () {
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 2,
						nav: false
					},
					1000: {
						items: 3,
						nav: true,
						loop: false,
						margin: 20
					}
				}
			})
		})
	</script>
	<link rel="stylesheet" href="{{asset('assets/css/owl.theme.css')}}" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}" type="text/css" media="screen" property="" />
	<!-- //carousel(for feedback) -->

	<!-- flexisel(for filter) -->
	<script src="{{asset('assets/js/jquery.flexisel.js')}}"></script>
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: {
					portrait: {
						changePoint: 480,
						visibleItems: 1
					},
					landscape: {
						changePoint: 640,
						visibleItems: 2
					},
					tablet: {
						changePoint: 768,
						visibleItems: 3
					}
				}
			});

		});
	</script>
	<!-- //flexisel(for filter) -->

	<!-- smooth scrolling -->
	<script src="{{asset('assets/js/SmoothScroll.min.js')}}"></script>
	<!-- move-top -->
	<script src="{{asset('assets/js/move-top.js')}}"></script>
	<!-- easing -->
	<script src="{{asset('assets/js/easing.js')}}"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="{{asset('assets/js/outdoor.js')}}"></script>

	<script src="{{asset('assets/js/bootstrap.js')}}"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- //Js files -->


</body>

</html>