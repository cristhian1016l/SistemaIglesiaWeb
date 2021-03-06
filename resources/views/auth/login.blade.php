<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
<title> Inicio de Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=" Master  Login Form Widget Tab Form,Login Forms,Sign up Forms,Registration Forms,News letter Forms,Elements"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="/assets/css/style-login.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Cormorant+SC:300,400,500,600,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>

<body>
	<div class="padding-all">
		<div class="header">
			<h1>Inicio de Sesión - Iglesia Primitiva</h1>
		</div>

		<form method="POST" action="{{ route('login') }}">
		@csrf
        <div class="design-w3l">
			<div class="mail-form-agile">
				<form action="#" method="post">
					<input id="email" type="email" name="email" placeholder="Email" required=""/><!-- autocomplete="off" -->
					<input id="password" type="password"  name="password" class="padding" placeholder="Contraseña" required=""/>
					<input type="submit" value="Iniciar Sesión">
				</form>
			</div>
		  <div class="clear"> </div>
		</div>
        </form>
		
		<div class="footer">
		<p>© 2019 <a href="https://iglesiaprimitiva.net/" >Iglesia Primitiva</a></p>
		</div>
	</div>
</body>
</html>