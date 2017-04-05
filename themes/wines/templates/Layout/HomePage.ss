    <section id="banner">
    	<div class="banner-home">
    		$Photo.CroppedImage(1800,773)
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
							<a href="$Link">
							$Photo.CroppedImage(600, 400)
							<figcaption>
								<button class="btn btn-brown">More</button>
							</figcaption>
							</a>
						</figure>
						<div class="description open-sans">
							<div>
							$Teaser
							<a href="$Link">Find out more.</a>
							</div>
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
				<a href="https://www.instagram.com/tikiwines/" target="_blank"><i class="icon-instagram-1 instagram-lg"></i></a>
				<h3 class="mt-25 mb-70"><span class="roman">Join the conversation</span> <a href="https://www.instagram.com/tikiwines/" target="_blank">@tikiwines</a></h3>
			</div>
      		<div id="instafeed" class="row"></div>
		</div>
	</section>
