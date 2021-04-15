<?php

class Model
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'oopscrud';
    private $conn;

    /*Database  Connection*/
    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            echo 'Connection failed';
        } else {
            return $this->conn;
        }
    }

    /*Function for Insert Record in Database */
    public function insertRecord($post)
    {
        $name = $post['name'];
        $email = $post['email'];

        $sql = "INSERT INTO users (name,email) VALUES ('$name','$email')";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=ins');
        } else {
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }

    /*Function for display record */
    public function displayRecord()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function displayRecordById($editid)
    {
        $sql = "SELECT * FROM users WHERE  id = '$editid'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    public function updateRecord($post)
    {
        $name = $post['name'];
        $email = $post['email'];
        $editid = $post['hid'];
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id = '$editid'";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=ups');
        } else {
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function deleteRecord($deleteid)
    {
        $sql = "DELETE FROM users WHERE id = '$deleteid'";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:index.php?msg=dlt');
        } else {
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }
}