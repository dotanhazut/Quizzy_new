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

$cmid = required_param('id', PARAM_INT);

$context = context_module::instance($cmid);
require_login($course, true, $cm);

if (has_capability('mod/quizzy:manage', $context)) {
    // Redirect teachers and managers to teacher_view.php
    echo "Redirecting to teacher_view.php";
    redirect(new moodle_url('/mod/quizzy/teacher_view.php', ['id' => $cmid, 'courseid' => $courseid]));
} elseif (has_capability('mod/quizzy:view', $context)) {
    // Redirect students and guests to std_view.php
    echo "Redirecting to std_view.php";
    redirect(new moodle_url('/mod/quizzy/std_view.php', ['id' => $cmid, 'courseid' => $courseid]));
} else {
    // Redirect everyone else to view.php
    echo "Redirecting to view.php";
    $context = context_module::instance($cm->id);
    $PAGE->set_url('/mod/quizzy/view.php', array('id' => $cm->id));
    $PAGE->set_title(format_string($quizzy->name));
    $PAGE->set_heading(format_string($course->fullname));

    echo $OUTPUT->header();
    echo $OUTPUT->heading(format_string($quizzy->name));

// Add your plugin's main content here.

    echo $OUTPUT->footer();
}