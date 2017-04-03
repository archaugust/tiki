<% if $UseButtonTag %>
	<button id="recaptcha1" class="btn btn-gold">
		<% if $ButtonContent %>$ButtonContent<% else %>$Title.XML<% end_if %>
	</button> <div id="subscribeDiv"></div>
<% else %>
	<input $AttributesHTML />
<% end_if %>