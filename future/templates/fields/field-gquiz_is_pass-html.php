<?php
/**
 * The default quiz pass/fail field output template.
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

// If there's no grade, don't continue
if ( gv_empty( $display_value, false, false ) ) {
	return;
}

// Check if grading is enabled for the form. If not set, default to false.
$grading_type_enabled = ! empty( $form['gravityformsquiz']['grading'] ) ? $form['gravityformsquiz']['grading'] : 'none';

if ( 'passfail' === $grading_type_enabled ) {

	// By default, the field value is "1" for Pass and "0" for Fail. We want the text.
	echo GFCommon::replace_variables( '{quiz_passfail}', $form, $entry );

} elseif ( GVCommon::has_cap( 'gravityforms_edit_forms' ) ) {
	$grade_type = __( 'Pass/Fail', 'gravityview' );
	printf( esc_html_x( '%s grading is disabled for this form. %sChange the setting%s', '%s is the current Quiz field type ("Letter" or "Pass/Fail")', 'gravityview' ), $grade_type, '<a href="'. admin_url('admin.php?page=gf_edit_forms&amp;view=settings&amp;subview=gravityformsquiz&amp;id='.$form['id'] ) . '">', '</a>' );
}
