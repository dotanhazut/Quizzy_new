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

defined('MOODLE_INTERNAL') || die();

function quizzy_add_instance($quizzy) {
    global $DB;
    $quizzy->timecreated = time();
    $quizzy->id = $DB->insert_record('quizzy', $quizzy);
    return $quizzy->id;
}

function quizzy_update_instance($quizzy) {
    global $DB;
    $quizzy->timemodified = time();
    $quizzy->id = $quizzy->instance;
    return $DB->update_record('quizzy', $quizzy);
}

function quizzy_delete_instance($id) {
    global $DB;
    if (!$quizzy = $DB->get_record('quizzy', array('id' => $id))) {
        return false;
    }
    $DB->delete_records('quizzy', array('id' => $quizzy->id));
    return true;
}