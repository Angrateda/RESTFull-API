<?php
class Rest
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = "";
    private $database = "json";
    private $psnTable = 'pasien';
    private $dbConnect = false;
    // skrip fungsi-fungsi letakkan/sisipkan disini

    public function __construct()
    {
        if (!$this->dbConnect) {
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
    }


    public function getPasien($psnId)
    {
        $sqlQuery = '';
        if ($psnId) {
            $sqlQuery = "WHERE id_pasien = '" . $psnId . "'";
        }
        $psnQuery = "
        SELECT id_pasien, nama, lahir, penyakit, goldarah,biaya
        FROM " . $this->psnTable . " $sqlQuery
        ORDER BY id_pasien ASC";
        $resultData = mysqli_query($this->dbConnect, $psnQuery);
        $psnData = array();
        while ($psnRecord = mysqli_fetch_assoc($resultData)) {
            $psnData[] = $psnRecord;
        }
        header('Content-Type: application/json');
        echo json_encode($psnData);
    }


    public function insertPasien($psnData)
    {
        $psnNama = $psnData["nama"];
        $psnLahir = $psnData["lahir"];
        $psnPenyakit = $psnData["penyakit"];
        $psnGoldarah = $psnData["goldarah"];
        $psnBiaya = $psnData["biaya"];
        $psnQuery = "
            
            INSERT INTO " . $this->psnTable . "
            SET nama='" . $psnNama . "', lahir='" . $psnLahir . "', penyakit='" . $psnPenyakit . "', goldarah='" . $psnGoldarah . "', biaya='" . $psnBiaya . "'";
        mysqli_query($this->dbConnect, $psnQuery);
        if (mysqli_affected_rows($this->dbConnect) > 0) {
            $message = "pasien sukses dibuat.";
            $status = 1;
        } else {
            $message = "pasien gagal dibuat.";
            $status = 0;
        }
        $psnResponse = array(
            'status' => $status,
            'status_message' => $message
        );
        header('Content-Type: application/json');
        echo json_encode($psnResponse);
    }


    public function updatePasien($psnData)
    {
        if (isset($psnData["id"])) {
            $psnNama = $psnData["nama"];
            $psnLahir = $psnData["lahir"];
            $psnPenyakit = $psnData["penyakit"];
            $psnGoldarah = $psnData["goldarah"];
            $psnBiaya = $psnData["biaya"];
            $psnQuery = "
            UPDATE " . $this->psnTable . "
            SET nama='" . $psnNama . "', lahir='" . $psnLahir . "', penyakit='" . $psnPenyakit . "', goldarah='" . $psnGoldarah . "', biaya='" . $psnBiaya . "'
            WHERE id_pasien = '" . $psnData["id"] . "'";
            mysqli_query($this->dbConnect, $psnQuery);
            if (mysqli_affected_rows($this->dbConnect) > 0) {
                $message = "pasien sukses diperbaiki.";
                $status = 1;
            } else {
                $message = "pasien gagal diperbaiki.";
                $status = 0;
            }
        } else {
            $message = "Invalid request.";
            $status = 0;
        }
        $psnResponse = array(
            'status' => $status,
            'status_message' => $message
        );
        header('Content-Type: application/json');
        echo json_encode($psnResponse);
    }



    public function deletePasien($psnId)
    {
        if ($psnId) {
            $psnQuery = "
        DELETE FROM " . $this->psnTable . "
        WHERE id_pasien = '" . $psnId . "'
        ORDER BY id_pasien DESC";
            mysqli_query($this->dbConnect, $psnQuery);
            if (mysqli_affected_rows($this->dbConnect) > 0) {
                $message = "pasien sukses dihapus.";
                $status = 1;
            } else {
                $message = "pasien gagal dihapus.";
                $status = 0;
            }
        } else {
            $message = "Invalid request.";
            $status = 0;
        }
        $psnResponse = array(
            'status' => $status,
            'status_message' => $message
        );
        header('Content-Type: application/json');
        echo json_encode($psnResponse);
    }
}
?>