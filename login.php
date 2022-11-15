<?php
$servername = "localhost"; // kopplar till din lokala databas som körs i xampp
$username = "root";
$password = "";
$db = "myDB"; //använd namnet på din databas

// Skapa connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Kontrollera connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


/* 
  Här används ett "prepared statement" för att säkra inloggningen. 
  Den här koden är mindre känslig för SQL injection-attack. 
*/
$stmt = $conn->prepare("SELECT * FROM users where username = ?"); //? anger en parameter som vi ska sätta värdet på längre ned.
$stmt->bind_param("s", $_POST["username"]); //här sätter vi värdet på parametern ? till det username som angivits.
$stmt->execute(); // Vi kör frågan mot databasen.
$result = $stmt->get_result(); // Vi hämtar resultatet.

if ($result->num_rows == 1) { // Vi har hittat exakt en user i databasen med det username som angavs.
  $row = $result->fetch_assoc();

  // Dags att verifiera om det angivna lösenordet är den klartext
  // som motsvarar hashen i kolumnen password i databasen.
  $cleartext_password = $_POST["password"];
  $password_hash_value = $row["password"];

  if (password_verify($cleartext_password, $password_hash_value)) {
    echo "Du är inloggad.";
  } else {
    echo "Inloggning misslyckades."; // Användaren hittades men lösenordet var fel.
  }
} else {
  echo "Inloggning misslyckades."; // Vi hittade inte exakt en användare med det username
}
$conn->close();
