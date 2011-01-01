<?php
/**
 * Upload a new file
 *
 * @package ElggFile
 */

elgg_load_library('elgg:file');

elgg_set_page_owner_guid(get_input('guid'));
$owner = elgg_get_page_owner();

gatekeeper();
group_gatekeeper();

$title = elgg_echo('file:new');

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('file'), "pg/file/all/");
if (elgg_instanceof($owner, 'user')) {
	elgg_push_breadcrumb($owner->name, "pg/file/owner/$owner->username");
} else {
	elgg_push_breadcrumb($owner->name, "pg/file/group/$owner->guid/owner");
}
elgg_push_breadcrumb($title);

// create form
$form_vars = array('enctype' => 'multipart/form-data');
$body_vars = file_prepare_form_vars();
$content = elgg_view_form('file/upload', $form_vars, $body_vars);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	'buttons' => '',
));

echo elgg_view_page($title, $body);
