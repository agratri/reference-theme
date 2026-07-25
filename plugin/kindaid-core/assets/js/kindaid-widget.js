/**
 * KindAid Core — media uploader for classic WP_Widget forms.
 *
 * Markup contract (see include/wp-widgets/*.php):
 *
 *   <input type="text" class="widefat kindaid-upload-field" name="…" value="…">
 *   <button type="button" class="button select-media-button">Upload</button>
 *   <span class="kindaid-upload-preview"></span>   <!-- optional -->
 *
 * The handler is delegated from document, so it keeps working for widgets added
 * after page load and inside the Customizer, where widget forms are injected
 * dynamically. One frame instance is cached per input.
 */
( function ( $ ) {
	'use strict';

	var l10n = window.kindaidWidgetL10n || {};

	function frameTitle() {
		return l10n.frameTitle || 'Select or upload an image';
	}

	function buttonText() {
		return l10n.buttonText || 'Use this image';
	}

	/**
	 * Find the text input this button belongs to.
	 *
	 * Prefers an explicit data-target, then the nearest preceding field, then any
	 * field inside the same wrapper — so the markup can be reordered without the
	 * script breaking.
	 */
	function resolveInput( $button ) {
		var target = $button.data( 'target' );

		if ( target ) {
			var $explicit = $( '#' + target );
			if ( $explicit.length ) {
				return $explicit;
			}
		}

		var $prev = $button.prevAll( '.kindaid-upload-field' ).first();
		if ( $prev.length ) {
			return $prev;
		}

		return $button.closest( 'p, .widget-content, .kindaid-upload-wrap' )
			.find( '.kindaid-upload-field' )
			.first();
	}

	function renderPreview( $input, url ) {
		var $preview = $input.siblings( '.kindaid-upload-preview' ).first();

		if ( ! $preview.length ) {
			return;
		}

		if ( ! url ) {
			$preview.empty();
			return;
		}

		$preview.html(
			$( '<img>', {
				src: url,
				alt: '',
				css: { maxWidth: '100%', height: 'auto', marginTop: '8px' }
			} )
		);
	}

	$( document ).on( 'click', '.select-media-button', function ( event ) {
		event.preventDefault();

		if ( typeof wp === 'undefined' || ! wp.media ) {
			return;
		}

		var $button = $( this );
		var $input  = resolveInput( $button );

		if ( ! $input.length ) {
			return;
		}

		// Reuse the frame for this button so reopening keeps the previous selection.
		var frame = $button.data( 'kindaidFrame' );

		if ( ! frame ) {
			frame = wp.media( {
				title: frameTitle(),
				button: { text: buttonText() },
				library: { type: 'image' },
				multiple: false
			} );

			frame.on( 'select', function () {
				var attachment = frame.state().get( 'selection' ).first().toJSON();

				$input.val( attachment.url ).trigger( 'change' );
				renderPreview( $input, attachment.url );
			} );

			$button.data( 'kindaidFrame', frame );
		}

		frame.open();
	} );

	// Clear button, if the widget form provides one.
	$( document ).on( 'click', '.kindaid-remove-media', function ( event ) {
		event.preventDefault();

		var $input = resolveInput( $( this ) );

		$input.val( '' ).trigger( 'change' );
		renderPreview( $input, '' );
	} );

	// Paint previews for values already saved when a form is opened.
	$( document ).on( 'widget-added widget-updated', function ( event, $widget ) {
		$widget.find( '.kindaid-upload-field' ).each( function () {
			renderPreview( $( this ), $( this ).val() );
		} );
	} );

	$( function () {
		$( '.kindaid-upload-field' ).each( function () {
			renderPreview( $( this ), $( this ).val() );
		} );
	} );

}( jQuery ) );
