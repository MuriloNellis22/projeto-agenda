<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;

if (!empty($data)) {
    if ($data["type"] === "create") {
        
        $name = $data["name"];
        $email = $data["email"];
        $observations = $data["observations"];

        $query = "INSERT INTO contacts (name, email, observations) VALUES (:name, :email, :observations)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $observations);

        try {

            $stmt->execute();
            $_SESSION["msg"] = "Contato criado com sucesso!";
    
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }

    } else if ($data["type"] === "edit") {
        
        $name = $data["name"];
        $email = $data["email"];
        $observations = $data["observations"];
        $id = $data["id"];

        $query = "UPDATE contacts 
        SET name = :name, email = :email, observations = :observations 
        WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $observations);
        $stmt->bindParam(":id", $id);

        try {

            $stmt->execute();
            $_SESSION["msg"] = "Contato atualizado com sucesso!";
    
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }

    } else if ($data["type"] === "delete") {
        
        $id = $data["id"];

        $query = "DELETE FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        try {

            $stmt->execute();
            $_SESSION["msg"] = "Contato removido com sucesso!";
    
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }

    }

    header("Location:" . $BASE_URL . "../index.php");

} else {
    
    $id;

    if (!empty($_GET)) {
        $id = $_GET["id"];
    }

    if (!empty($id)) {
        
        $query = "SELECT * FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $contact = $stmt->fetch();

    } else {

        $contacts = [];
    
        $query = "SELECT * FROM contacts";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $contacts = $stmt->fetchAll();
    }

}

$conn = null;