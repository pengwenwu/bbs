<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Page couldn't be found.</title>
		<!-- <link rel="stylesheet" media="screen" href="/static/css/style.css"> -->
		<style type="text/css">
			@-webkit-keyframes appear{
	from{
		opacity: 0;
		}
	to 	{
		opacity: 1;
	}
}

@-webkit-keyframes headline_appear_animation{
	from{
		opacity: 0;
	}
	25% {
		opacity: 0;
	}	
	to 	{
		opacity: 1;
	}
}

@-webkit-keyframes contentappear{
	from {
		-webkit-transform: scale(0);
		opacity: 0;
	}
	50% {
		-webkit-transform:  scale(0.5);
		opacity: 0;
	}
	to {
		-webkit-transform: scale(1);
		opacity: 1;
	}
}

@-moz-keyframes appear{
	from{
		opacity: 0;
		}
	to 	{
		opacity: 1;
	}
}

@-moz-keyframes headline_appear_animation{
	from{
		opacity: 0;
	}
	25% {
		opacity: 0;
	}	
	to 	{
		opacity: 1;
	}
}

@-moz-keyframes contentappear{
	from {
		-moz-transform: scale(0);
		opacity: 0;
	}
	50% {
		-moz-transform:  scale(0.5);
		opacity: 0;
	}
	to {
		-moz-transform: scale(1);
		opacity: 1;
	}
}

* {
	margin: 0;
	padding: 0;
}

/*################ Sliding and appearing animation for the 404 page. Works in webkit browsers and mozilla firefox.*/

a:active{
	position: relative;
	top: 1px;
}

html{
	background: url(/static/images/background-3.png) no-repeat center center fixed;
	/*Image for the full size image background. If you want to have a color as a background, just remove the complete html{} style and uncomment the last line in the body{}*/
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	/*CSS3 for the fullscreen image background*/
}

body{
	font-family: 'Helvetica Neue';
	width: auto;
	margin: 0 auto 100px auto;
/*	background: #C9D0F5 /*373A4D*!/;*/
}

.header {
	position: fixed;
	top: 0;
	width: 100%;
	height: 55px;
	padding: 0 0 0 10px;
	
	color: #fff;
	background-image: -moz-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	background-image: -o-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	background-image: -webkit-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0,1));
	background-image: linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	border-top: 1px solid #000;
	box-shadow: inset 0px 1px rgba(255, 255, 255, 0.4),
				0px 0px 13px #000000;
				
	z-index: 99;
	-webkit-animation: 1s appear;
	-moz-animation: 1s appear;
}

p.error {
	color: #000;
	text-shadow: #fff 0 1px 0;
	text-align:center;
	font:900 25em helvetica neue;
	-webkit-animation: 2s headline_appear_animation;
	-moz-animation: 2s headline_appear_animation;
	  					 
}

.content {
	margin: auto;
	padding: 30px 40px 40px 40px;
	width: 570px;
	
	color: #fff;
	-webkit-animation: 2s contentappear;
	-moz-animation: 2s contentappear;
	background-image: -moz-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	background-image: -o-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	background-image: -webkit-linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0,1));
	background-image: linear-gradient(top, rgba(85, 85, 85, 0.7), rgba(0,0,0, 1));
	border: 1px solid #000;
	box-shadow: inset 0px 1px rgba(255, 255, 255, 0.4),
				0 3px 8px #000000;
	border-radius: 6px;
	
	font: 16px;
	line-height: 25px;
	font-weight: 300;
	text-shadow: #000 0 1px 0;
}

.content h2{
	text-transform: uppercase;
	text-align: center;
	padding-bottom: 20px;
}

form {
	height: 40px;
}

.inputform {
	font: 12px;
	border: none;
	padding: 10px;
	width: 300px;
	margin: 15px 0 0 75px;
}

.button {
	width: 100px;
	margin-top: 1px;
	height: 33px;
	border: none;
	
	text-shadow: #fff  0 1px 0;
	background-image: -moz-linear-gradient(top, #ffffff, #aaa);
	background-image: -o-linear-gradient(top, #ffffff, #aaa);
	background-image: -webkit-linear-gradient(top, #ffffff, #aaa);
	background-image: linear-gradient(top, #ffffff, #aaa);
	box-shadow: inset 0px 1px rgba(255, 255, 255, 1);
}

.button:hover {
	background-image: -moz-linear-gradient(top, #ffffff, #ccc);
	background-image: -o-linear-gradient(top, #ffffff, #ccc);
	background-image: -webkit-linear-gradient(top, #ffffff, #ccc);
	background-image: linear-gradient(top, #ffffff, #ccc);
	cursor: pointer;
}

.button:active {
	background-image: -moz-linear-gradient(top, #ccc, #fff);
	background-image: -o-linear-gradient(top, #ccc, #fff);
	background-image: -webkit-linear-gradient(top, #ccc, #fff);
	background-image: linear-gradient(top, #ccc, #fff);
}

p.links {
	margin: 24px 0 0 0;
	text-align: center;
}

p.links a {
	color: #fff;
	margin-left: 15px;
	margin-right: 15px;
}

p.links a:hover {
	text-decoration: none;
	text-shadow: #fff 0 0 5px;
	-webkit-transition: all ease-in 0.3s;
	-moz-transition: all ease-in 0.3s;
}
		</style>
		<script language="JavaScript">
			function dosearch() {
			var sf=document.searchform;
			var submitto = sf.sengine.value + escape(sf.searchterms.value);
			window.location.href = submitto;
			return false;
			}
		</script>
	</head>
	<body>
		
		<div class="header">
			<img src="/static/images/Logo_sample.png" />
		</div>
		
		<p class="error">404</p>
		
		<div class="content">
			<h2>page coulnd't be found</h2>
			
			<p class="text">
				Oooooops… it looks like the page you were looking for does not exist anymore or is temporarily unavailable. You might want to search our website or browse our website. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
			
				<form name="searchform" onSubmit="return dosearch();">
					<input type="hidden" name="sengine" value="http://www.google.com/search?q=site:www.yoursite.com+" />
					<input type="text" name="searchterms" class="inputform">
					<input type="submit" name="SearchSubmit" value="Search" class="button"> 
				</form>
				<!-- Change www.yoursite.com to your website domain -->
			</p>
				
			<p class="links">
				<a id="button" href="http://www.cssmoban.com/">&larr; Back</a> <a href="#">Homepage</a> <a href="#">Portfolio</a> <a href="#">About Us</a> <a href="#">Blog</a>
				<!--These are links. You can change it to a page you want to by replacing the '#' with your url.-->
			</p>
		</div>
		
	</body>
</html>