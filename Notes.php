Stud status
 0 - Not validate
 1 - Validate 
 2 - Done

Stud payment status 
 0 - Not pay 
 1 - Partial
 2 - Fully paid

PHP mailer code 
- pgjpvspfpauidugk

manual x 2= 16 hrs 
matic x1 = 8hrs 
motor manual x2 = 16hrs 
motor matic x1= 8hrs

$email = mysqli_real_escape_string($conn, $_POST['email']);

HOST - ftp.mikaelarealty.com
USERNAME - msferrando@msferrando.mikaelarealty.com
PASS - dave1234

$db_host = "localhost";
$db_user = "mikaelty_dave";
$db_pass = "IAKxScG3uv7Ilu1U";
$db_name = "mikaelty_msferrando";

Name Server 1
ns8365.hostgator.com

Name Server 2
ns8366.hostgator.com

FTP Account
ferrando@msferrandodriving.com
gator4183.hostgator.com
ferrando

Database Login
username: msfering_msferra
pass: msfering_msferrando

<?php
$db_host = "localhost";
$db_user = "msfering_msferra";
$db_pass = "msfering_msferrando";
$db_name = "msfering_msferrando";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno())
{
	echo 'Unknown Database : '.mysqli_connect_error();
}
?>

<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
			$('[data-toggle="tooltip"]').tooltip(); 
			CKEDITOR.replace('thank_you_email_body');	
		
	});

	var htl = CKEDITOR.instances['thank_you_email_body'].getData(); //get the note
</script>

<script src="https://cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'note', {
        customConfig: '/ckeditor/config.js'
    } );
	note = CKEDITOR.instances.note.getData(); // get the note
</script>