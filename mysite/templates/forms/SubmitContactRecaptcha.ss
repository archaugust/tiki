<% if $UseButtonTag %>
	<button id="recaptcha2" class="btn btn-gold">
		<% if $ButtonContent %>$ButtonContent<% else %>$Title.XML<% end_if %>
	</button> <div id="contactDiv"></div>
<% else %>
	<input $AttributesHTML />
<% end_if %>