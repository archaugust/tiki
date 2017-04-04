    <section id="banner">
    	<div class="banner mb-70">
    		<img src="$BannerImage.CroppedImage(1800,467).URL" alt="$Title" />
    	</div>
    </section>
	<section id="content">
		<div class="container text-center open-sans">
			<h2>$Title</h2>
			$Content
		</div>
	</section>
	<section id="brandtypes">
		<div class="container mb-70">
			<div class="box-labels ph-70">
				<div class="row">
				<% loop $BrandTypes %>
				<div class="col-md-4 col-sm-6 box-label" id="label-$Pos">
					<figure class="wine">
						$Photo.SetWidth(80)
					</figure>
					<h3><span>$SubTitle</span><br />$Title</h3>
					<div class="more"><div>Learn More</div></div>
					<img src="$ThemeDir/images/wine-arrow.png" class="arrow" />
				</div>
				<% end_loop %>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="brand-details" class="bg-gray open-sans pv-70">
			<div class="container">
			<a href="#" id="close"><img src="$ThemeDir/images/icon-close.png" title="Close" alt="Close" /></a>
			<% loop $BrandTypes %>
				<div class="row ph-70" id="details-$Pos">
					<div class="col-md-10">
						<h3>$ParentWineBrand.Title <span>$Title</span> - <span class="subtitle">$SubTitle</span></h3>
						$Text
					</div>
					<div class="col-md-2 text-center">
						$Photo.SetWidth(126)
					</div>
				</div>
			<% end_loop %>
			</div>
		</div>
		<div class="brands-menu">
			<div class="container">
				<% loop $Wines %>
				<div class="menu-item" id="link-$Pos"><a href="$Link">$Title</a></div>
				<% end_loop %>
			</div>
		</div>
	</section>