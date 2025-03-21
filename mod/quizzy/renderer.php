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

class mod_quizzy_renderer extends plugin_renderer_base {
    public function render_quizzy($quizzy) {
        $output = '';
        $output .= html_writer::start_div('quizzy');
        $output .= html_writer::tag('h2', format_string($quizzy->name), array('class' => 'quizzy-name'));
        $output .= html_writer::div(format_text($quizzy->intro), 'quizzy-intro');
        $output .= html_writer::end_div();
        return $output;
    }
}