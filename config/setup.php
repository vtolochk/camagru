<?php
    exec("~/Library/Containers/MAMP/mysql/bin/mysql -u vtolochk -pvtolochk < ./dbInfo.sql 2>&- ");
    echo "Data base was created.\n";
?>