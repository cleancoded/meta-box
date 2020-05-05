<script id="tmpl-cleancoded-image-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="cleancoded-media-input">
	<div class="attachment-preview">
		<div class="thumbnail">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes[data.controller.imageSize] ) { #>
						<img src="{{{ data.sizes[data.controller.imageSize].url }}}">
					<# } else { #>
						<img src="{{{ data.sizes.full.url }}}">
					<# } #>
				<# } else { #>
					<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
						<img src="{{ data.image.src }}" />
					<# } else { #>
						<img src="{{ data.icon }}" />
					<# } #>
				<# } #>
			</div>
		</div>
	</div>
	<div class="cleancoded-image-overlay"></div>
	<div class="cleancoded-image-actions">
		<a class="cleancoded-image-edit cleancoded-edit-media" title="{{{ i18ncleancodedMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
			<span class="dashicons dashicons-edit"></span>
		</a>
		<a href="#" class="cleancoded-image-delete cleancoded-remove-media" title="{{{ i18ncleancodedMedia.remove }}}">
			<span class="dashicons dashicons-no-alt"></span>
		</a>
	</div>
</script>
