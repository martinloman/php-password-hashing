<?php
//---------------------------------------
// Exempel-kod, hashning
//---------------------------------------

// Se dokumentation för hash() som kan skapa hashvärden med hjälp av olika
// hashningsalgoritmer. https://www.php.net/manual/en/function.hash.php
echo "SHA256: " . hash("sha256", $_POST["password"]);
echo "<br>";
echo "MD5: " . hash("md5", $_POST["password"]);
echo "<br>";

// Se dokumentation för password_hash() https://www.php.net/manual/en/function.password-hash.php
$hash_value = password_hash($_POST["password"], PASSWORD_DEFAULT);
echo "Password hash: " . $hash_value;
echo "<br>";

// Se dokumentation för password_verify() https://www.php.net/manual/en/function.password-verify.php
echo "Password ok: " . password_verify($_POST["password"], $hash_value);
