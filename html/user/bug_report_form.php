<?php

include_once("util.inc");
include_once("db.inc");

function print_platform_select() {
    echo "
        <select name=platform>
    ";

    $result = mysql_query("select * from platform");
    while ($platform = mysql_fetch_object($result)) {
        echo"
            <option value=$platform->name>$platform->user_friendly_name
        ";
    }
    mysql_free_result($result);
    echo "</select>\n";
}

$authenticator = init_session();
db_init();

$user = get_user_from_auth($authenticator);
if ($user == NULL) {
    print_login_form();
    exit();
}
page_head("Problem Report Form", $user);

echo "
    <h3>Problem Report Form</h3>
    <form method=post action=bug_report_action.php>
";
start_table();
row2_init("Computer type", "");
print_platform_select();
echo" </td></tr>\n";
row2("Problem description",
    "<textarea name=problem rows=10 cols=80></textarea>"
);
row2("",
    "<input type=submit value=\"Submit problem report\">"
);
end_table();
echo" </form> ";
page_tail();

?>
