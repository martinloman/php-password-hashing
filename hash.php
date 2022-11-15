<?php
// Exempel-kod, hashning
echo "SHA256: " . hash("sha256", $_POST["password"]);
echo "<br>";
echo "MD5: " . hash("md5", $_POST["password"]);
echo "<br>";
$hash_value = password_hash($_POST["password"], PASSWORD_DEFAULT);
echo "Password hash: " . $hash_value;
echo "<br>";
echo "Password ok: " . password_verify($_POST["password"], $hash_value);
