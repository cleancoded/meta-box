<script id="tmpl-cleancoded-media-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="cleancoded-media-input">
	<div class="cleancoded-media-preview attachment-preview">
		<div class="cleancoded-media-content thumbnail">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes.thumbnail ) { #>
						<img src="{{{ data.sizes.thumbnail.url }}}">
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
	<div class="cleancoded-media-info">
		<a href="{{{ data.url }}}" class="cleancoded-media-title" target="_blank">
			<# if( data.title ) { #>
				{{{ data.title }}}
			<# } else { #>
				{{{ i18ncleancodedMedia.noTitle }}}
			<# } #>
		</a>
		<p class="cleancoded-media-name">{{{ data.filename }}}</p>
		<p class="cleancoded-media-actions">
			<a class="cleancoded-edit-media" title="{{{ i18ncleancodedMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				<span class="dashicons dashicons-edit"></span>{{{ i18ncleancodedMedia.edit }}}
			</a>
			<a href="#" class="cleancoded-remove-media" title="{{{ i18ncleancodedMedia.remove }}}">
				<span class="dashicons dashicons-no-alt"></span>{{{ i18ncleancodedMedia.remove }}}
			</a>
		</p>
	</div>
</script>

<script id="tmpl-cleancoded-media-status" type="text/html">
	<# if ( data.maxFiles > 0 ) { #>
		{{{ data.length }}}/{{{ data.maxFiles }}}
		<# if ( 1 < data.maxFiles ) { #>{{{ i18ncleancodedMedia.multiple }}}<# } else {#>{{{ i18ncleancodedMedia.single }}}<# } #>
	<# } #>
</script>

<script id="tmpl-cleancoded-media-button" type="text/html">
	<a class="button">{{{ data.text }}}</a>
</script>
