<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>@yield("title", "Inicio") - SkiesPlanet</title>
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

    @yield('styles')
</head>

<body>
	@include('general.header')
    
    @yield('contenido')

    @include('general.copyright')


	<!-- Js files -->
	<!-- JavaScript -->
	<script src="{{asset('assets/js/jquery-2.2.3.min.js')}}"></script>
	<!-- Default-JavaScript-File -->
	<script src="{{asset('assets/js/bootstrap.js')}}"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<script src="{{asset('assets/scripts/ajax.js')}}"></script>
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
			});

			$('#tipoId').on('change', function() {
				var selectPais = $( "#tipoId option:selected" ).data( "selectpais" );
				var selectCiudad = $( "#tipoId option:selected" ).data( "selectciudad" );

				var data = {};
				data = {
					_token: $('input[name=_token]').val(),
					tipoReserva: $( "#tipoId option:selected" ).val()
				};
				ajaxRequest($( "#tipoId option:selected" ).data('url'), data, 'tipoReserva', 'paises');
			});

			$( "#fecha" ).blur(function() {
				var dtToday = new Date();
        
				var month = dtToday.getMonth() + 1;
				var day = dtToday.getDate();
				var year = dtToday.getFullYear();
			
				if(month < 10)
					month = '0' + month.toString();
				if(day < 10)
					day = '0' + day.toString();
			
				var minDate = year + '-' + month + '-' + day;
				if(Date.parse(minDate) > Date.parse(this.value)) {
					document.getElementById('fecha').value = minDate;
				}
			});
		});
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

    <script>
        $(function(){
            var dtToday = new Date();
        
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
        
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
        
            var minDate = year + '-' + month + '-' + day;    
            $('#fecha').attr('min', minDate);
        });
    </script>

    @yield('scripts')
</body>

</html>