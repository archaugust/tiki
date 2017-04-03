    <section id="banner">
    	<div class="banner-home">
    		$Photo.CroppedImage(1800,610)
    		<div class="banner-text">
    			$BannerText
    		</div>
    	</div>
    	<div class="container text-center pv-70">
			$Content
		</div>
    </section>
    
	<section id="content" class="bg-gray">
		<div class="container pv-70 ph-70 text-center">
			$SubIntro
			<div class="row home-pages">
				<% loop $Pages %>
				<div class="col-md-6">
					<div class="home-page">
						<figure class="more">
							$Photo.CroppedImage(600, 400)
							<figcaption>
								<a href="$Link" class="btn btn-brown">More</a>
							</figcaption>
						</figure>
						<div class="description open-sans">
							$Teaser
							<a href="$Link">Find out more.</a>
						</div>
					</div>
				</div>
				<% end_loop %>
			</div>
		</div>
	</section>
	
	<section id="social">
		<div class="container">
			<h2>Latest Video</h2>
			<div class="open-sans">Watch more Tiki videos <a href="https://www.youtube.com/channel/UCOOD7YlB-r7humg5Ll0RJJQ" target="_blank">here.</a></div>
			<div class="video">
				<div class="video-container">$VideoEmbedCode</div>
			</div>
			<div class="gold">
				<i class="icon-instagram-1 instagram-lg"></i>
				<h3 class="mt-25 mb-70"><span class="roman">Join the conversation</span> <a href="https://www.instagram.com/tikiwines/" target="_blank">@tikiwines</a></h3>
			</div>
			<!--
			<form action="https://api.instagram.com/oauth/access_token" method="post">
				<input type="text" name="client_id" value="13bfbc9d1f7f4eb9b3fd41465ab76b05">
				<input type="text" name="client_secret" value="ce322063b19c485cb0fa224cfe33c9be">
				<input type="text" name="grant_type" value="authorization_code">
				<input type="text" name="redirect_uri" value="http://tiki.dev">
				<input type="text" name="code" value="809d1ca6b837400186b3dfbe3e6b06c6">
				<input type="submit">
			</form>
			-->
      		<div id="instafeed"></div>
		</div>
	</section>
