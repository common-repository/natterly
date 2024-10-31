<?php

if (!defined("WP_UNINSTALL_PLUGIN"))
{
  die();
}

delete_option("natterly_token");
delete_site_option("natterly_token");
