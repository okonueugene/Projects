<?php
class sms extends CI_Model{
function hit($mobile)
{

	$sms="http://bulksms2.wkbusiness.in/submitsms.jsp?user=Rsgroup&key=950436fdcaXX&mobile=+91".$mobile."&message=Dear Investor Thanks for choosing RSGroup , Your account is under review , after verfication you will get notification from our Team- RSGroup&senderid=RSGRUP&accusage=1";

return header("Location:$sms");
}

}

?>