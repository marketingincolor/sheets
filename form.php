<?php
/**
 * Name: Doe
 * Date: 05/15/2017
 * Purpose: Sending data to Google Sheets Service.
 */
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='IE=edge' http-equiv='X-UA-Compatible'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
  </head>
  <body>
    <form id='foo' action="submit.php" method="post">
      <p>
        <label>Name</label>
        <input id='name' name='name' type='text'>
      </p><p>
        <label>Email Address</label>
        <input id='email' name='email' type='email'>
      </p><p>
        <label>Phone Number</label>
        <input id='phone' name='phone' type='tel'>
      </p><p>
        <label>Message</label>
        <textarea id='message' name='message' rows='5'></textarea>
      </p>
        <div id='success'></div>
        <button type='submit'>Send</button>
    </form>

</html>