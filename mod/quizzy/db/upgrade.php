<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade script for the Quizzy module.
 *
 * This script updates the database schema based on `install.xml`.
 *
 * @param int $oldversion The current version of the module before the upgrade.
 * @return bool True on success.
 */
function xmldb_quizzy_upgrade($oldversion) {
    global $DB;

    // Get database manager.
    $dbman = $DB->get_manager();

    // Upgrade process for version 2025031800.
    if ($oldversion < 2025031800) {

        // Define the quizzy table.
        $table = new xmldb_table('quizzy');

        // Check if the column `column_to_remove` exists and remove it.
        $field = new xmldb_field('column_to_remove');
        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }

        // Recreate the table structure based on `install.xml`.
        xmldb_quizzy_refresh_schema();

        // Save the upgrade point.
        upgrade_mod_savepoint(true, 2025031800, 'quizzy');
    }

    return true;
}

/**
 * Refreshes the database schema based on `install.xml`.
 *
 * This function ensures that the database structure matches the latest version.
 */
function xmldb_quizzy_refresh_schema() {
    global $CFG, $DB;

    require_once($CFG->dirroot . '/lib/ddllib.php');

    // Load and apply the XMLDB structure.
    $dbman = $DB->get_manager();
    $xmldb_file = $CFG->dirroot . '/mod/quizzy/db/install.xml';

    if (file_exists($xmldb_file)) {
        $structure = new database_manager();
        $structure->install_from_xmldb_file($xmldb_file);
    }
}
