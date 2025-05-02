The TwoFactorCodeMail class is responsible for sending the 2FA code to the user's email. Here's how it works:

Constructor: It takes the 2FA code as input when the mail is created and stores it in the $code property.
build() Method: This method sets the email subject and specifies the Blade view (emails.two_factor_code) to use for the email content. The 2FA code is passed to the view using the with() method.
In short, this class handles the email setup for sending the 2FA code to users.
