<?php
/**
 * The default date field output template.
 *
 * @since future
 */
$field_id = $gravityview->field->ID;
$field = $gravityview->field->field;
$value = $gravityview->value;
$form = $gravityview->view->form->form;
$display_value = $gravityview->display_value;
$entry = $gravityview->entry->as_entry();
$field_settings = $gravityview->field->as_configuration();

/**
 * Unix Epoch probably isn't what you're looking for.
 * @since 1.7
 */
if ( $value === '1970-01-01' ) {

	/**
	 * @filter `gravityview/fields/date/hide_epoch` Whether to hide `1970-01-01` dates; that is normally an erroneous date. Return false to show value. Use `__return_false` callback.
	 * @param bool $hide_epoch True: hide values that are 1970-01-01. False: show the value.
	 *
	 * @since future
	 * @param The $gravityview context object.
	 */
	$hide_epoch = apply_filters( 'gravityview/fields/date/hide_epoch', true, $gravityview );

	if ( $hide_epoch ) {
		return;
	}
}

if ( ! empty( $field_settings ) && ! empty( $field_settings['date_display'] ) && ! empty( $value ) ) {

	// If there is a custom PHP date format passed via the date_display setting,
	// use PHP's date format
	$format = $field_settings['date_display'];
	$output = date_i18n( $format, strtotime( $value ) );

} else {

	$output = GravityView_Field_Date::date_display( $value, rgar( $field, "dateFormat" ), $field_id );

}

echo $output;