<?php
require_once('../../config.php');
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        die("Error: Missing 'id' parameter.");
    }
    $question = required_param('question', PARAM_TEXT);
    $ans1 = required_param('answer_1', PARAM_TEXT);
    $ans2 = required_param('answer_2', PARAM_TEXT);
    $ans3 = required_param('answer_3', PARAM_TEXT);
    $ans4 = required_param('answer_4', PARAM_TEXT);
    $correct_ans = required_param('correct_answer', PARAM_TEXT);

    $record = new stdClass();
    $record->question = $question;
    $record->ans1 = $ans1;
    $record->ans2 = $ans2;
    $record->ans3 = $ans3;
    $record->ans4 = $ans4;
    $record->correct_ans = $correct_ans;
    $record->status = '0'; // ברירת מחדל

    $DB->insert_record('quizzy_questions_std', $record);

    redirect(new moodle_url('/mod/quizzy/std_view.php', array('id' => required_param('id', PARAM_INT))));
}

