<?php
require('controller/controller.php');

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'logIn')
    {
        logIn();
    }
    elseif ($_GET['action'] == 'signIn')
    {
        signIn();
    }
}
else
{
echo "";
}
