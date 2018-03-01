jQuery(document).ready(function ($) {
	var digi_vars = [];	
	digi_vars['add_new_download'] = 'Add New Product';
	digi_vars['use_this_file'] = 'Use This File';
	digi_vars['quick_edit_warning'] = 'Sorry, not available for variable priced products.';
	digi_vars['one_option'] = 'Choose a product';
	digi_vars['one_or_more_option'] = 'Choose one or more product';
	digi_vars['numeric_item_price'] = 'Item price must be numeric';
	digi_vars['numeric_item_tax'] = 'Item tax must be numeric';
	digi_vars['numeric_quantity'] = 'Quantity must be numeric';
	
	// Tooltips
	$('.digi-help-tip').tooltip({
		content: function() {
			return $(this).prop('title');
		},
		tooltipClass: 'digi-ui-tooltip',
		position: {
			my: 'center top',
			at: 'center bottom+10',
			collision: 'flipfit',
		},
		hide: {
			duration: 200,
		},
		show: {
			duration: 200,
		},
	});

	/**
	 * Download Configuration Metabox
	 */
	var Digi_Download_Configuration = {
		init : function() {
			this.add();
			this.move();
			this.remove();
			this.type();
			this.prices();
			this.files();
			this.updatePrices();
		},
		clone_repeatable : function(row) {

			// Retrieve the highest current key
			var key = highest = 1;
			row.parent().find( 'tr.digi_repeatable_row' ).each(function() {
				var current = $(this).data( 'key' );
				if( parseInt( current ) > highest ) {
					highest = current;
				}
			});
			key = highest += 1;

			clone = row.clone();

			/** manually update any select box values */
			clone.find( 'select' ).each(function() {
				$( this ).val( row.find( 'select[name="' + $( this ).attr( 'name' ) + '"]' ).val() );
			});

			clone.removeClass( 'digi_add_blank' );

			clone.attr( 'data-key', key );
			clone.find( 'td input, td select, textarea' ).val( '' );
			clone.find('td input.digi_repeatable_index').val(key);
			clone.find( 'input, select, textarea' ).each(function() {
				var name = $( this ).attr( 'name' );
				var id   = $( this ).attr( 'id' );

				if( name ) {

					name = name.replace( /\[(\d+)\]/, '[' + parseInt( key ) + ']');
					$( this ).attr( 'name', name );

				}
//alert(key);
				//$( this ).attr( 'data-key', key );

				if( typeof id != 'undefined' ) {

					id = id.replace( /(\d+)/, parseInt( key ) );
					$( this ).attr( 'id', id );

				}

			});

			clone.find( 'span.digi_price_id' ).each(function() {
				$( this ).text( parseInt( key ) );
			});

			clone.find( 'span.digi_file_id' ).each(function() {
				$( this ).text( parseInt( key ) );
			});

			clone.find( '.digi_repeatable_default_input' ).each( function() {
				$( this ).val( parseInt( key ) ).removeAttr('checked');
			});

			clone.find( '.digi_repeatable_condition_field' ).each ( function() {
				$( this ).find( 'option:eq(0)' ).prop( 'selected', 'selected' );
			} )

			// Remove Chosen elements
			clone.find( '.search-choice' ).remove();
			clone.find( '.chosen-container' ).remove();

			return clone;
		},

		add : function() {
			$( document.body ).on( 'click', '.submit .digi_add_repeatable', function(e) {
				e.preventDefault();
				var button = $( this ),
				row = button.parent().parent().prev( 'tr' ),
				clone = Digi_Download_Configuration.clone_repeatable(row);

				clone.insertAfter( row ).find('input, textarea, select').filter(':visible').eq(0).focus();

				// Setup chosen fields again if they exist
				clone.find('.digi-select-chosen').chosen({
					inherit_select_classes: true,
					placeholder_text_single: digi_vars.one_option,
					placeholder_text_multiple: digi_vars.one_or_more_option,
				});
				clone.find( '.digi-select-chosen' ).css( 'width', '100%' );
				clone.find( '.digi-select-chosen .chosen-search input' ).attr( 'placeholder', digi_vars.search_placeholder );
			});
		},

		move : function() {

			$(".digi_repeatable_table tbody").sortable({
				handle: '.digi_draghandle', items: '.digi_repeatable_row', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
					var count  = 0;
					$(this).find( 'tr' ).each(function() {
						$(this).find( 'input.digi_repeatable_index' ).each(function() {
							$( this ).val( count );
						});
						count++;
					});
				}
			});

		},

		remove : function() {
			$( document.body ).on( 'click', '.digi_remove_repeatable', function(e) {
				e.preventDefault();

				var row   = $(this).parent().parent( 'tr' ),
					count = row.parent().find( 'tr' ).length - 1,
					type  = $(this).data('type'),
					repeatable = 'tr.digi_repeatable_' + type + 's',
					focusElement,
					focusable,
					firstFocusable;

					// Set focus on next element if removing the first row. Otherwise set focus on previous element.
					if ( $(this).is( '.ui-sortable tr:first-child .digi_remove_repeatable:first-child' ) ) {
						focusElement  = row.next( 'tr' );
					} else {
						focusElement  = row.prev( 'tr' );
					}

					focusable  = focusElement.find( 'select, input, textarea, button' ).filter( ':visible' );
					firstFocusable = focusable.eq(0);

				if ( type === 'price' ) {
					var price_row_id = row.data('key');
					/** remove from price condition */
					$( '.digi_repeatable_condition_field option[value="' + price_row_id + '"]' ).remove();
				}

				if( count > 1 ) {
					$( 'input, select', row ).val( '' );
					row.fadeOut( 'fast' ).remove();
					firstFocusable.focus();
				} else {
					switch( type ) {
						case 'price' :
							alert( digi_vars.one_price_min );
							break;
						case 'file' :
							$( 'input, select', row ).val( '' );
							break;
						default:
							alert( digi_vars.one_field_min );
							break;
					}
				}

				/* re-index after deleting */
				$(repeatable).each( function( rowIndex ) {
					$(this).find( 'input, select' ).each(function() {
						var name = $( this ).attr( 'name' );
						name = name.replace( /\[(\d+)\]/, '[' + rowIndex+ ']');
						$( this ).attr( 'name', name ).attr( 'id', name );
					});
				});
			});
		},

		type : function() {

			$( document.body ).on( 'change', '#_digi_product_type', function(e) {

				var digi_products            = $( '#digi_products' ),
					digi_download_files      = $( '#digi_download_files' ),
					digi_download_limit_wrap = $( '#digi_download_limit_wrap' );

				if ( 'bundle' === $( this ).val() ) {
					digi_products.show();
					digi_download_files.hide();
					digi_download_limit_wrap.hide();
				} else {
					digi_products.hide();
					digi_download_files.show();
					digi_download_limit_wrap.show();
				}

			});

		},

		prices : function() {
			$( document.body ).on( 'change', '#digi_variable_pricing', function(e) {
				var checked   = $(this).is(':checked');
				var single    = $( '#digi_regular_price_field' );
				var variable  = $( '#digi_variable_price_fields,.digi_repeatable_table .pricing' );
				if ( checked ) {
					single.hide();
					variable.show();
				} else {
					single.show();
					variable.hide();
				}
			});
		},

		files : function() {
			var file_frame;
			window.formfield = '';

			$( document.body ).on('change', '.digi_upload_file_button', function(e) {

				e.preventDefault();

				var button = $(this);
				var fileinfo = this.files;
				
				var selectedSize, selectedName;

				window.formfield = $(this).closest('.digi_repeatable_upload_wrapper');
				if( fileinfo ) {
					file = fileinfo[0];
					selectedSize = file.size;
					selectedName = file.name;
					window.formfield.find( '.digi_repeatable_name_field' ).val( selectedName );
				}
			});


			var file_frame;
			window.formfield = '';

		},

		updatePrices: function() {
			$( '#digi_price_fields' ).on( 'keyup', '.digi_variable_prices_name', function() {

				var key = $( this ).parents( 'tr' ).data( 'key' ),
					name = $( this ).val(),
					field_option = $( '.digi_repeatable_condition_field option[value=' + key + ']' );

				if ( field_option.length > 0 ) {
					field_option.text( name );
				} else {
					$( '.digi_repeatable_condition_field' ).append(
						$( '<option></option>' )
							.attr( 'value', key )
							.text( name )
					);
				}
			} );
		}

	};

	Digi_Download_Configuration.init();

	//$('#edit-slug-box').remove();

	// Date picker
	var digi_datepicker = $( '.digi_datepicker' );
	if ( digi_datepicker.length > 0 ) {
		var dateFormat = 'mm/dd/yy';
		digi_datepicker.datepicker( {
			dateFormat: dateFormat
		} );
	}
});