<?php
/**
 * Plugin Name: Natterly
 * Plugin URI: https://natterly.com
 * Description: An official plugin created to make it easier to embed Natterly
 * Author: aTech Media
 * Author URI: https://atech.media
 * Version: 1.0.0
 */

function natterly_enqueue_scripts()
{
  $token = get_option("natterly_token");

  if (isset($token) && strlen($token) > 0)
  {
    $javascript = "window.chatbox = new NatterlyChatbox('$token'); chatbox.render();";

    wp_enqueue_script("natterly-chatbox", "https://cdn.natterly.com/chatbox.js", array(), "1.0.0", true);
    wp_add_inline_script("natterly-chatbox", $javascript);
  }
}

add_action("wp_enqueue_scripts", "natterly_enqueue_scripts");

function natterly_plugin_menu()
{
  add_options_page("Natterly Options", "Natterly", "manage_options", "natterly-options", "natterly_options_page");
}

add_action("admin_menu", "natterly_plugin_menu");

function natterly_options_page()
{
  if (!current_user_can("manage_options"))
  {
    wp_die(__("You do not have sufficient permissions to access this page."));
  }

  $token = get_option("natterly_token");
  $updated = false;

  if (natterly_valid_request())
  {
    $submitted = $_POST["natterly_token"];

    if (natterly_valid_token($submitted))
    {
      $updated = true;
      update_option("natterly_token", $submitted);
      $token = $submitted;
    }
    else
    {
      $error = "The token you entered was invalid";
    }
  }

  include(plugin_dir_path(__FILE__) . "/templates/options-page-template.php");
}

function natterly_valid_request()
{
  $submit = $_POST["natterly_submit_hidden"];
  return isset($submit) && $submit == "Y" && check_admin_referer("update-natterly-options");
}

function natterly_valid_token($token)
{
  if (strlen($token) === 0)
  {
    return true;
  }

  return preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i", $token);
}
