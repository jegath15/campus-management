<?php
if (file_exists("../assets/config.php")) {
    echo "Path ../assets/config.php EXISTS relative to " . __DIR__;
} else {
    echo "Path ../assets/config.php MISSING relative to " . __DIR__;
}
?>
