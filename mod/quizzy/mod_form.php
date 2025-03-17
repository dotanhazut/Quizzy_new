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

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_quizzy_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;

        // Add the general header.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Add the name field.
        $mform->addElement('text', 'name', get_string('quizzyname', 'mod_quizzy'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', null, 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'quizzyname', 'mod_quizzy');

        // Add the intro field.
        $this->standard_intro_elements();

        // Add the timing fieldset.
        $mform->addElement('header', 'timing', get_string('timing', 'mod_quizzy'));

        // Add the timeopen field.
        $mform->addElement('date_time_selector', 'timeopen', get_string('quizzyopen', 'mod_quizzy'), array('optional' => true));
        $mform->addHelpButton('timeopen', 'quizzyopen', 'mod_quizzy');

        // Add the timeclose field.
        $mform->addElement('date_time_selector', 'timeclose', get_string('quizzyclose', 'mod_quizzy'), array('optional' => true));
        $mform->addHelpButton('timeclose', 'quizzyclose', 'mod_quizzy');

        // Add standard grading elements.
        $this->standard_grading_coursemodule_elements();

        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add action buttons.
        $this->add_action_buttons();
    }
}