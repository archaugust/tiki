<!DOCTYPE html>
<html lang="en">
  <head>
  	<% base_tag %>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<% if $MetaDescription %>$MetaDescription<% else %>$Content.FirstSentence<% end_if %>">

	<title>$SiteConfig.Title - <% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %></title>

    <!--[if IE 7]><link rel="stylesheet" href="$ThemeDir/css/fontello-ie7.css"><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <section id="header">
    	<div class="container">
    		<a href="$AbsoluteBaseURL" class="logo"><img src="$ThemeDir/images/logo.png" alt="Tiki" /></a>
    		<div class="dropdown-container">
			  <div class="menu-button" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Menu"></div>
			  <div class="dropdown-menu menu-body" aria-labelledby="dLabel">
		  		<div class="row">
		  			<div class="col-md-offset-4 col-md-4"> 
				  		<ul class="list-unstyled">
				          	<% loop $Menu(1) %>
			          		<li class="$LinkingMode<% if $Last%> last<% end_if %>">
					            <a href="$Link">$MenuTitle</a>
							</li>
				            <% end_loop %>
				  		</ul>
				  		<div class="social-links">
				  			<a href="https://www.facebook.com/TikiWines/" target="blank"><i class="icon-facebook"></i></a>
							<a href="https://www.instagram.com/tikiwines/" target="blank"><i class="icon-instagram-1"></i></a>
							<a href="https://www.youtube.com/channel/UCOOD7YlB-r7humg5Ll0RJJQ" target="blank"><i class="icon-youtube-1"></i></a>
							<a href="https://twitter.com/TikiWines" target="blank"><i class="icon-twitter"></i></a>
				  		</div>
			  		</div>
			  	</div>
			  </div>
    		</div>
    	</div>
    </section>
    <section id="body">

	$Layout
	
	<section id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<h2>Stay in Touch</h2>
					<hr class="thick" />
					<div class="open-sans">
						Receive news & information on special promotions, <span class="nowrap">straight to your inbox on a monthly basis.</span>
					</div>
				</div>
				<div class="col-md-7">
					<div class="subscribe">
						<div id="subscribeForm">
							$SubscribeForm
						</div>
					</div>
				</div>
			</div>
			<hr class="thin mb-40" />
			<div class="row">
				<div class="col-md-7 mb-25">
					<h3>Contact</h3>
					<hr class="thick" />
					<div class="row open-sans full-1200">
						<div class="col-md-5">
							Tiki Wine & Vineyards<br />
							PO Box 17 655, Sumner, 8840<br />
							9/18 Taurus Place, Bromley<br />
							Christchurch 8063
						</div>
						<div class="col-md-5">
							Email: <b class="email">$EncryptedEmail.Tag</b><br />
							<span class="white-link">
							Free Phone NZ: 0800 TIKI WINE<br />
							Phone: +64 3 326 5551
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<h3>Connect</h3>
					<img src="$ThemeDir/images/sustainable-growing-stamp.png" class="stamp" alt="Our Family Grows Sustainably" />
					<hr class="thick" />
					<div class="social-links gold">
						<a href="https://www.facebook.com/TikiWines/" target="blank"><i class="icon-facebook"></i></a>
						<a href="https://www.instagram.com/tikiwines/" target="blank"><i class="icon-instagram-1"></i></a>
						<a href="https://www.youtube.com/channel/UCOOD7YlB-r7humg5Ll0RJJQ" target="blank"><i class="icon-youtube-1"></i></a>
						<a href="https://twitter.com/TikiWines" target="blank"><i class="icon-twitter"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom open-sans">
			© Tiki Wine & Vineyards 2017 &nbsp; <a class="nowrap" href="http://spinifexnz.com" target="_blank">Website by Spinifex</a>
		</div>
		<a href="javascript:" id="return-to-top"><i class="icon-up-open"></i></a>
	</section>
	</section>
	$EncryptedEmail.Script
  </body>
</html>