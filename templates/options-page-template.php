<?php if ($error): ?>
  <div class="error">
    <p><strong><?php echo $error; ?></strong></p>
  </div>
<?php endif; ?>

<?php if ($updated): ?>
  <div class="updated">
    <p><strong>Your Natterly options have been saved</strong></p>
  </div>
<?php endif; ?>

<div class="wrap">
  <h1>Natterly Options</h1>
  <form method="POST" name="natterly-options">
    <?php echo wp_nonce_field("update-natterly-options"); ?>
    <input
      name="natterly_submit_hidden"
      type="hidden"
      value="Y"
    />
    <table class="form-table">
      <tbody>
        <tr>
          <th class="row">
            <label for="natterly-token">Your Site Token</label>
          </th>
          <td>
            <input
              autocomplete="off"
              id="natterly-token"
              class="regular-text ltr"
              name="natterly_token"
              spellcheck="false"
              type="text"
              value="<?php echo $token; ?>"
            />
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <input
        class="button button-primary"
        id="submit"
        name="submit"
        type="submit"
        value="Save Changes"
      />
    </p>
  </form>
</div>
