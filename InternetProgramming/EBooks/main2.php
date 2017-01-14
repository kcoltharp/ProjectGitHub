<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Kenny's Home</title>
        <link href="css/base.css" rel="stylesheet" type="text/css">
		<link href="css/menu.css" rel="stylesheet" type="text/css">
		<script src="/javascript/paginator.js" type="text/javascript"></script>
    </head>
    <body>
		<script type="text/javascript">
			// var name = prompt("Please enter your first name.");
			// alert("Welcome to the electronic book database, " + name + ". The menu system throughout these web pages will help you find the book you are looking for! Use it wisely and Happy Reading!!" );
		</script>
        <div class="container">
            <div class="topnav">
                <a class="button" href="../main.php">Home</a>
                <a class="button" href="main.php">List Books by Author's Last Name (Descending)</a>
                <a class="button" href="search/searchForm.inc.php">Search Books</a>
                <a class="button" href="change_password.php">Change Your Password</a>
                <a class="button" href="mailto:webmaster@kennys-spot.org">Contact Me</a>
            </div>
            <header>
                <h2 class="toptext">Welcome to Kennys-Spot</h2>				
            </header>
            <div>
                <aside>
                    <script src="http://www.gmodules.com/ig/ifr?url=http://www.caribsso.com/City/xml/charleston-sc.xml&amp;synd=open&amp;w=160&amp;h=250&amp;title=Charleston%2C+SC+News&amp;border=%23ffffff%7C0px%2C1px+solid+%23998899%7C0px%2C1px+solid+%23aa99aa%7C0px%2C2px+solid+%23bbaabb%7C0px%2C2px+solid+%23ccbbcc&amp;output=js">
					</script>
					<span>
						<a id="weather" href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:29440.1.99999&bannertypeclick=wu_blueglass"><img src="http://weathersticker.wunderground.com/cgi-bin/banner/ban/wxBanner?bannertype=wu_blueglass&airportcode=KGGE&ForcedCity=Georgetown&ForcedState=SC" alt="Click for Georgetown, South Carolina Forecast" height="90" width="160"></a>
					</span>
				</aside>
            </div>
			<div>
				<aside class="imglinks">
					<a id="face" href="http://www.facebook.com/kenny.coltharp"><img src="images/facebook-1.jpg" align="middle"></a><a href="http://www.gamecocksonline.com/"><img src="images/GamecockLogo.jpg" align="middle"></a>
				</aside>
			</div>
            <div>
                <article class="content">
					<div>
						<section class="columns">
							<h2>Announcements</h2><br />
							<p>Currently we have about 7 thousand books for your reading enjoyment!<br />
							Coming Soon we will have music in our database for you to download and enjoy, until then<br />
							<b>HAPPY READING!!</b></p>
						</section>
					</div>
					<div>
						<section id="quote">
							<!--JavaScript code for Quotes of the Day, http://www.tqpage.com/-->
							<script language="JavaScript" src="http://www.quotationspage.com/data/qotd.js" type="text/javascript">
							</script> <!--End JavaScript Quotations code-->
						</section>
					</div>
					<div>
						<section>
							<table>
								<?php
								$pages_dir = 'C:/server/www/PHP/EBooks/php';

								if ( ! empty ( $_GET[ 'p' ] ) )
								{
									$pages = scandir ( $pages_dir, 0 );
									unset ( $pages[ 0 ], $pages[ 1 ] );

									$p = $_GET[ 'p' ];

									if ( in_array ( $p . '.inc.php', $pages ) )
									{
										include ($pages_dir . '/' . $p . '.inc.php');
									}
									else
									{
										echo 'Sorry, page not found!';
									}
								}
								else
								{
									include('C:/server/www/PHP/EBooks/php/home.inc.php');
								}
								?>
							</table>
						</section>
					</div>
				</article>
				<script type="text/javascript">
					pag = new Paginator('paginator', 1674, 15, 1, "", true);
				</script>
            </div>
            <footer>
                <p>&copy;, 2011, Kenny Coltharp</p>
                <p><a href="index.php">Home</a>	<a href="intriguing_links.php">Intriguing Links</a>	<a href="about_me.php">About Me</a>	<a href="portfolio.php">Portfolio</a>	<a href="scripts-programs.php">Scripts\Programs</a>	<a href="mailto:webmaster@kennys-spot.org">Contact Me</a>
                </p>
            </footer>
        </div>
    </body>
</html>
