<?php
echo "<h1>Session Diagnostic</h1>";
echo "Session Save Path: " . ini_get('session.save_path') . "<br>";
echo "Is writable? " . (is_writable(ini_get('session.save_path')) ? 'Yes' : 'No') . "<br>";

// Try to set a custom save path to a local writable folder if the current one fails
$local_session_path = dirname(__FILE__) . '/sessions';
if (!is_dir($local_session_path)) {
    mkdir($local_session_path, 0777, true);
}
echo "Local Session Path: $local_session_path<br>";
echo "Is local path writable? " . (is_writable($local_session_path) ? 'Yes' : 'No') . "<br>";
?>
