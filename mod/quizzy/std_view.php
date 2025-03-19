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

echo html_writer::start_tag('form', array('method' => 'post', 'action' => 'save_question.php'));

echo html_writer::empty_tag('input', array(
    'type' => 'hidden',
    'name' => 'id',
    'value' => $cm->id
));


$table = new html_table();
$table->attributes['dir'] = 'rtl';
$table->head = array('שאלה', '1', '2', '3', '4', 'תשובה נכונה');

$question = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'question', 'class' => 'form-control'));
$input1 = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'answer_1', 'class' => 'form-control'));
$input2 = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'answer_2', 'class' => 'form-control'));
$input3 = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'answer_3', 'class' => 'form-control'));
$input4 = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'answer_4', 'class' => 'form-control'));
$correct_answer = html_writer::empty_tag('input', array('type' => 'text', 'name' => 'correct_answer', 'class' => 'form-control'));

$table->data[] = array($question, $input1, $input2, $input3, $input4, $correct_answer);
echo html_writer::table($table);

echo html_writer::tag('div',
    html_writer::empty_tag('input', array(
        'type' => 'submit',
        'value' => 'SEND',
        'class' => 'btn btn-info',
        'style' => 'padding: 5px 40px; font-size: 16px;'
    )),
    array('style' => 'text-align: center; margin-top: 10px;')
);

echo html_writer::end_tag('form');
echo $OUTPUT->footer();
