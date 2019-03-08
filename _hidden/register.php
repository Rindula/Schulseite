<?php 

require_once("mysqlconn.php");



/* Form Required Field Validation */
if ($_POST["register-user"] == "Registrieren") {

foreach($_POST as $key=>$value) {
	if(empty($_POST[$key])) {
		$error_message = "Du musst alle Felder ausfüllen";
	break;
	}
}

$email = $_POST["email"];

// if (isset($_POST["secret"]) && isset($_POST["response"])) {
// 	# Space for thoughts...
// } elseif (isset($error_message)) {
// 	$error_message .= "\nDas Captcha wurde nicht gelöst!";
// } else {
// 	$error_message .= "Das Captcha wurde nicht gelöst!";
// }

/* Password Matching Validation */
if($_POST['password'] != $_POST['confirm_password'] && !isset($error_message)){ 
	$error_message = 'Die Passwörte sollten gleich sein!<br>'; 
}

/* Email Validation */
if(!isset($error_message)) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error_message = "E-Mail Addresse ungültig!";
	}
}

/* Validation to check if Terms and Conditions are accepted */
if(!isset($error_message)) {
	if(!isset($_POST["terms"])) {
		$error_message = "Du musst die Nutzungsbedingungen akzeptieren!";
	}
}
if(!isset($error_message)) {
$reg_key = $_POST["reg_key"];
$valid = false;
$error_message = "Ungültiger Registrierungsschlüssel!";
foreach ($dbs->query('SELECT * FROM reg_keys') as $r) {
	if($reg_key == $r["reg_key"]) {
		if($r["counting"] > 0 || $r["counting"] == -1) {
			unset ($error_message);
			$valid = true;
			$init_group = $r["init_group"];
			$uses = $r["uses"] + 1;
			$count = ($r["counting"] == -1) ? - 1 : $r["counting"] - 1;
			$prep = $dbs->prepare("UPDATE reg_keys SET uses = '" . $uses ."', counting = '" . $count . "' WHERE reg_key = :reg_key");
			$prep->execute(array(":reg_key" => $reg_key));
		} else {
			$error_message = "Der Registrierungsschlüssel ist bereits aufgebraucht!";
		}
	}
}
}
if(!isset($error_message) && $valid) {
	$query = "INSERT INTO users (email, vorname, name, passwort, gruppe) VALUES (:email, :firstName, :lastName, :passwort, '$init_group')";
	$stmt = $dbs->prepare($query);
	$result = $stmt->execute(array(
		":email" => $email,
		":firstName" => $_POST["firstName"],
		":lastName" => $_POST["lastName"],
		":passwort" => password_hash($_POST["password"], PASSWORD_DEFAULT)
	));
	if($result) {
		$error_message = "";
		$success_message = "Du hast dich erfolgreich registriert! Deine E-Mail ($email) ist aktiviert. <a href=\"/hausaufgaben\">Zurück zu den Hausaufgaben</a>";
		unset($_POST);
	} else {
		$error_message = "Es ist ein Problem aufgetreten. Bitte versuche es später nocheinmal!";	
	}
}

}

$reg_key = $_GET["reg_key"];
$valid = false;
foreach ($dbs->query('SELECT reg_key,counting FROM reg_keys') as $r) {
	if($reg_key == $r["reg_key"]) {
		if($r["counting"] > 0 || $r["counting"] == -1) {
			$valid = true;
		} else {
			$error_message = "Keine Registrierungen mit diesem Schlüssel möglich!";
		}
	}
}


?>
<style>
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
.register-table {
	background: #d9eeff;
	width: 100%;
	border-spacing: initial;
	margin: 2px 0px;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	border-radius: 4px;
	padding: 20px 40px;
}
.register-table td {
	padding: 15px 0px;
}
.registerInputBox {
	padding: 10px 30px;
	border: #a9a9a9 1px solid;
	border-radius: 4px;
}
.btnRegister {
	padding: 10px 30px;
	background-color: #3367b2;
	border: 0;
	color: #FFF;
	cursor: pointer;
	border-radius: 4px;
	margin-left: 10px;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
<form name="frmRegistration" method="post" action="">
	<table border="0" width="500" align="center" class="register-table">
		<?php if(!empty($success_message)) { ?>	
		<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
		<?php } ?>
		<?php if(!empty($error_message)) { ?>	
		<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
		<?php } ?>
		<tr>
			<td>Vorname</td>
			<td><input type="text" <?= ($valid) ? "required" : "disabled"; ?> class="registerInputBox" autocomplete="given-name" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
		</tr>
		<tr>
			<td>Nachname</td>
			<td><input type="text" <?= ($valid) ? "required" : "disabled"; ?> class="registerInputBox" autocomplete="family-name" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
		</tr>
		</tr>
		<tr>
			<td>Email Addresse</td>
			<td><input type="email" <?= ($valid) ? "required" : "disabled"; ?> class="registerInputBox" autocomplete="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></td>
		</tr>
		<tr>
			<td>Passwort</td>
			<td><input type="password" <?= ($valid) ? "required" : "disabled"; ?> class="registerInputBox" name="password" value=""></td>
		</tr>
		<tr>
			<td>Passwort wiederholen</td>
			<td><input type="password" <?= ($valid) ? "required" : "disabled"; ?> class="registerInputBox" name="confirm_password" value=""></td>
		</tr>
		<tr>
			<!-- <td><div class="g-recaptcha" data-sitekey="6LdBTjEUAAAAABCV_6kyRvLRNWcaWBNe2nEGzotV"></div></td> -->
			<td colspan=2>
			<input type="checkbox" name="terms"> Ich akzeptiere die <a target="datenschutz" href="/kontakt/datenschutz.php">Datenschutzbestimmungen</a> <input type="submit" name="register-user" value="Registrieren" class="btnRegister"></td>
		</tr>
	</table>
	<input type="hidden" name="reg_key" value="<?= $reg_key ?>">
</form>