
<td>
	<input type="text" name="digi_download_files[<?php echo $key; ?>][name]" class="digi_repeatable_name_field large-text" value="{{ $name }}" placeholder="{{getPhrase('file_name')}}"/>
</td>
<td>
	<select name="digi_download_files[<?php echo $key; ?>][type]" title="{{ getPhrase('please_select_type') }}" class="upload_type" data-index="{{ $index }}">
		<option value="file" <?php if( $type == 'file') echo 'selected';?>>{{ getPhrase('file') }}</option>
		<option value="url" <?php if( $type == 'url') echo 'selected';?>>{{ getPhrase('url') }}</option>
	</select>
</td>

<td>
	<div class="digi_repeatable_upload_field_container">
		<?php
		$field_type = $type;
		if( $field_type == 'url' )
			$field_type = 'text';
		?>
		<input type="{{ $field_type }}" name="digi_download_files[<?php echo $key; ?>][file]" class="digi_repeatable_upload_field digi_upload_field large-text digi_upload_file_button digi_upload_file_button_index_{{ $index }}" value="{{ $file_name }}" placeholder="URL Eg: http://site.com"/>
		<?php
		if( $type == 'file' && $file_name != '' ) {
			echo '<a href="'.UPLOAD_URL_PRODUCTS_DOWNLOADS.$file_name.'" target="_blank">View</a>';
		}
		?>
	</div>
</td>

<td class="pricing">
	<select name="digi_download_files[<?php echo $key;?>][condition]" class="digi_repeatable_condition_field">
	<option value="">{{getPhrase('please_select')}}</option>
	<?php
		$options = array();
		if ( $prices ) {
			foreach ( $prices as $price_key  ) {
				if( $price_key == $option ) {
					echo '<option value="'.$price_key.'" selected>' . $price_key . '</option>';
				} else {
					echo '<option value="'.$price_key.'">' . $price_key . '</option>';
				}
			}
		}
	?>
	</select>
</td>

<td>
	<span class="digi_file_id"><?php echo $key; ?></span>
</td>
<td>
	<button class="digi_remove_repeatable" data-type="file"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
</td>

