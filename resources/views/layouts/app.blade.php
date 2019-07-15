<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
	    <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <meta http-equiv="x-ua-compatible" content="ie=edge">
		  <title>@yield('title')</title>
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		  <!-- Bootstrap core CSS -->
		  <link href="/css/bootstrap.min.css" rel="stylesheet">
		  <!-- Material Design Bootstrap -->
		  <link href="/css/mdb.min.css" rel="stylesheet">
		  <!-- Your custom styles (optional) -->
		  <link href="/css/style.css" rel="stylesheet">
		  <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    </head>

		<body>
			<div id="app" v-cloak>
				@include('includes.navbar')

				<!-- @section('sidebar')
				this is sidebar
				@show -->

				<div class="content-wrapper">
					@yield('content')
				</div>

				@include('includes.footer')


				<prompt></prompt>
			</div>
		</body>

		<!-- SCRIPTS -->
		<!-- JQuery -->
		<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="/js/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="/js/mdb.min.js"></script>
		<!-- Axios -->
		<script type="text/javascript" src="/js/axios.js"></script>
		<!-- Moment -->
		<script type="text/javascript" src="/js/moment.js"></script>
		<!-- Vue JavaScript -->
		<script type="text/javascript" src="/js/vuejs.js"></script>
		<!-- Main JS -->
		<script type="text/javascript" src="/js/main.js"></script>

		@auth
			<script type="text/javascript">
				window.currentUser = {
					first_name: '{{ Auth::user()->first_name }}'
				};
			</script>
		@endauth
</html>
