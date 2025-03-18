<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); // Course Module ID.

$cm = get_coursemodule_from_id('quizzy', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$quizzy = $DB->get_record('quizzy', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
$PAGE->set_url('/mod/quizzy/teacher_view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($quizzy->name));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();

$table = new html_table();
$table->attributes['dir'] = 'rtl';
$table->head = array('שאלה', '1', '2', '3', '4', 'תשובה נכונה', 'פעולות');

// הוספת שאלה לדוגמה עם כפתורי אישור וביטול
$question = 'מהי בירת ישראל?';
$answer1 = 'ירושלים';
$answer2 = 'שועפט';
$answer3 = 'דבריה';
$answer4 = 'תל אביב';
$correct = 'תל אביב';

// יצירת קישורים עם GET (לפעולות אישור וביטול)
$approve_url = new moodle_url($_SERVER['REQUEST_URI'], array('question' => $question, 'action' => 'approve'));
$reject_url = new moodle_url($_SERVER['REQUEST_URI'], array('question' => $question, 'action' => 'reject'));

$approve_button = html_writer::link('#', '✔ אישור', array(
    'class' => 'btn btn-success',
    'onclick' => 'this.closest("tr").style.display="none"; return false;'));
$reject_button = html_writer::link('#', '❌ לא מאושר', array(
    'class' => 'btn btn-danger',
    'onclick' => 'this.closest("tr").style.display="none"; return false;'
));

$table->data[] = array($question, $answer1, $answer2, $answer3, $answer4, $correct, $approve_button . ' ' . $reject_button);

// הצגת הטבלה
echo html_writer::table($table);
// Add your plugin's main content here.

echo $OUTPUT->footer();