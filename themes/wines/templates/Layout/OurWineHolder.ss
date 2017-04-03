    <section id="banner">
    	<div class="banner">
    		<img src="$Photo.CroppedImage(1800,610).URL" alt="$Title" />
    		<div class="banner-text">
    			<div class="mb-25">
    				$BannerText
    			</div>
    			<a href="#brands"><img src="$ThemeDir/images/arrow-down.png" alt="Go down" /></a>
    		</div>
    	</div>
    </section>
	<section id="content" class="pv-100">
		<div class="container text-center">
			$Content
		</div>
	</section>
	<section id="brands" class="bg-gray">
		<div class="pv-55 bg-darker-gray text-center">
			<h2>Our Brands</h2>
		</div>
		<div class="brands-menu visible-lg">
			<div class="container">
				<ul class="list-inline">
					<% loop $Children %>
					<li class="menu-link" id="link-$Pos"><a href="$Link">$Title</a></li>
					<% end_loop %>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row box-wines">
				<% loop $Children %>
				<div class="col-md-6">
					<div class="box-wine" id="wine-$Pos">
						<a href="$Link">
						<figure class="wine">
							$Photo.SetWidth(80)
						</figure>
						</a>
						<div class="description open-sans">
							$Teaser
							<a href="$Link">Find out more.</a>
							<img src="$ThemeDir/images/arrow-up.png" alt="$Title" class="arrow" />
						</div>
					</div>
				</div>
				<% end_loop %>
			</div>
		</div>
	</section>