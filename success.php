<?php
$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("cours65db65cb1e7bc");
$store_passwd=urlencode("cours65db65cb1e7bc@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;

	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;

    echo "<div style='text-align:center; margin-top: 20px;'>
    <p><span style='font-weight:bold;'>Payment Status:</span> " . $status . "</p>" .
    "<p><span style='font-weight:bold;'>Payment Date:</span> " . $tran_date . "</p>" .
    "<p><span style='font-weight:bold;'>Your Transaction ID:</span> " . $tran_id . "</p>" .
    "<p><span style='font-weight:bold;'>Payment Method:</span> " . $card_type . "</p>
</div>";

echo "<div style='text-align:center; margin-top: 20px;' class='text-danger'>
    <p style='font-weight:bold;'>পেমেন্ট SUCCESSFUL !! ধন্যবাদ ❤️, <a href='../courses.php' style='color: #dc3545;'>Buy ANOTHER</a></p>
    <p style='font-weight:bold;'>✅অর্ডার  রিলেটেড  সমস্যা  হলে <a href='https://t.me/contractadmin24' style='color: #dc3545;'>ক্লিক করুন।</a></p>
</div>";



} else {
	echo "Failed to connect with SSLCOMMERZ";
}

?>