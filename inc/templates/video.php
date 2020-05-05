<script id="tmpl-cleancoded-video-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="cleancoded-media-input">
	<div class="cleancoded-media-preview">
		<div class="cleancoded-media-content">
			<div class="centered">
				<# if( _.indexOf( i18ncleancodedVideo.extensions, data.url.substr( data.url.lastIndexOf('.') + 1 ) ) > -1 ) { #>
				<div class="cleancoded-video-wrapper">
					<video controls="controls" class="cleancoded-video-element" preload="metadata"
						<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
						<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
						<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
						<source type="{{ data.mime }}" src="{{ data.url }}"/>
					</video>
				</div>
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
