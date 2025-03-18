<?php
require_once('../../config.php');
require_login();


$id = required_param('id', PARAM_INT); // Course Module ID.

$cm = get_coursemodule_from_id('quizzy', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$quizzy = $DB->get_record('quizzy', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
$PAGE->set_url('/mod/quizzy/std_view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));


echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('modulenameplural', 'mod_quizzy'));

// Add your custom content for students/guests here.

echo $OUTPUT->footer();