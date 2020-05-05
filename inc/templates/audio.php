<script id="tmpl-cleancoded-media-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="cleancoded-media-input">
	<div class="cleancoded-media-preview">
		<div class="cleancoded-media-content">
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
		<h4>
			<a href="{{{ data.url }}}" target="_blank" title="{{{ i18ncleancodedMedia.view }}}">
				<# if( data.title ) { #> {{{ data.title }}}
					<# } else { #> {{{ i18ncleancodedMedia.noTitle }}}
				<# } #>
			</a>
		</h4>
		<p>{{{ data.mime }}}</p>
		<p>
			<a class="cleancoded-edit-media" title="{{{ i18ncleancodedMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				<span class="dashicons dashicons-edit"></span>{{{ i18ncleancodedMedia.edit }}}
			</a>
			<a href="#" class="cleancoded-remove-media" title="{{{ i18ncleancodedMedia.remove }}}">
				<span class="dashicons dashicons-no-alt"></span>{{{ i18ncleancodedMedia.remove }}}
			</a>
		</p>
	</div>
</script>
