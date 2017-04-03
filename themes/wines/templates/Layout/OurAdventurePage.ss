    <section id="banner">
    	<div class="banner">
    		<img src="$Photo.CroppedImage(1800,710).URL" alt="$Title" />
    	</div>
    </section>
	<section id="content-adventure-page">
		<div class="container pv-100 ph-70">
			<div class="row">
				<div class="col-md-6">
					<h1>$Title</h1>
					<div class="date mb-25">$Date.Format('F Y')</div>
					<div class="content open-sans">
					$Content
					</div>
				</div>
				<div class="col-md-6 side-photos">
					<% loop $SidePhotos %>
						$Photo.SetWidth(480)
					<% end_loop %>
				</div>
			</div>
		</div>
	</section>