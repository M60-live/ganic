<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ganic Roots</title>
</head>
<style>
  .btn{
    padding: 15px 15px;
    background-color: #10542B;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
  }

  .footer{
    background-color: #649748;
    padding: 20px 20px;
    color: #fff;
  }
  .footer > td{
    vertical-align: text-top;
    padding: 20px 20px;
  }
</style>
<body style='font-family: Vedana,Arial; color:rgb(80, 80, 80); font-size: 12pt;'>
<center>
  <table border='0' cellpadding='0' cellspacing='0' width='800px'>
    <tbody>
    <tr><td width='350px'></td><td width='350px'></td></tr>
    <tr><td colspan="2"><img src='https://www.ganicroots.co.za/img/mail/mailBanner3.jpg' width='800'/></td></tr>
    <tr>
      <td>
        Message from the contact form
        <br>
        <br>
        Name: {{ $name }}
        <br>
        Email: {{ $email }}
        <br>
        Mobile Number: {{ $phone_number }}
        <br>
        Message: {{ $msg }}
        <br>
        <br>
        Ganic Roots
        <br>
        <br>
        <br>
        <a href='https://www.ganicroots.co.za' class='btn'>go to website</a>
        <br />
        <br />
      </td>
      <td></td>
    </tr>
    <tr class='footer'>
      <td>
        <b>Ganic Roots PTY (LTD)</b>
      </td>
      <td>
        info@ganicroots.co.za<br>
        Pretoria West<br>
        Pretoria<br>
        Gauteng, South Africa 0008
      </td>
    </tr>
    </tbody>
  </table>
</center>
</body>
</html>