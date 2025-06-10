<?php

function open_database() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (Exception $e) {
        throw $e;
    }
}

function close_database(&$pdo) {
    $pdo = null;
}
function criptografia($senha){
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
		return $hash;
	}

    function filter($table = null, $p = null)
    {
        $database = open_database();
        $found = null;
    
        try {
            if ($p) {
                $sql = "SELECT * FROM $table WHERE $p";
                $stmt = $database->query($sql);
                $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "Ocorreu um erro:" . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    
        close_database($database);
        return $found;
    }

function find($table, $id = null) {
    $db = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM $table WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $found = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM $table";
            $stmt = $db->query($sql);
            $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $found;
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($db);
}

function find_all($table) {
    return find($table);
}

function save($table, $array) {
    $db = open_database();

    

    
    $columns = implode(", ", array_keys($array));

    
    $values = ":" . implode(", :", array_keys($array));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

   
    
    try {
        $stmt = $db->prepare($sql);
        foreach ($array as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmt->execute();
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($db);
}



function update($table, $id, $array) {
    $db = open_database();
    $fields = "";

    
    $cleaned_array = [];
    foreach ($array as $key => $value) {
        $cleaned_key = trim($key, "'");
        $cleaned_array[$cleaned_key] = $value;
    }

    
    foreach ($cleaned_array as $key => $value) {
        $fields .= "$key = :$key, ";
    }
    $fields = rtrim($fields, ", ");
    
    $sql = "UPDATE $table SET $fields WHERE id = :id";
    
    
    try {
        $stmt = $db->prepare($sql);
        foreach ($cleaned_array as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['message'] = "Registro atualizado com sucesso.";
        $_SESSION['type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
    close_database($db);
}


function remove($table, $id) {
    $db = open_database();
    try {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['message'] = "Registro removido com sucesso.";
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($db);
}

function verificaDuplicadas($tabela, $campo, $nomeFoto) {
    $db = open_database();
    try {
        $sql = "SELECT COUNT(*) as total FROM $tabela WHERE $campo = :nomeFoto";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nomeFoto', $nomeFoto, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['total'] > 1);
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($db);
}

function clear_messages(){
    $_SESSION['message']=null;
    $_SESSION['type']=null;
}

function formatadata($data, $formato) {
    $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
    return $dt->format($formato);
}

function telefone($telefone) {
    return "(" . substr($telefone, 0, 2) . ")" . substr($telefone, 2, 5) . "-" . substr($telefone, 7);
}

function cpf($cpf) {
    return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9);
}

function cep($cep) {
    return substr($cep, 0, 5) . "-" . substr($cep, 5);
}

?>