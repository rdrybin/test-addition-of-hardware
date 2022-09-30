<?php
class DBOperations
{
    private const hn = 'localhost';
    private const db = 'test_er';
    private const un = 'root';
    private const pw = '';

    public static function getHardwareType($arrColumns)
    {
        $conn = new mysqli(self::hn, self::un, self::pw, self::db,);
        if ($conn->connect_error) die("Fatal Error");

        $columns = implode(',', $arrColumns);
        $query = "SELECT $columns FROM hardware_type";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    public static function getSerialMaskById($idHardwareType)
    {
        $conn = new mysqli(self::hn, self::un, self::pw, self::db,);
        if ($conn->connect_error) die("Fatal Error");

        $query = "SELECT serail_mask  FROM hardware_type WHERE id = {$idHardwareType}";
        $result = $conn->query($query);
        $conn->close();
        return mysqli_fetch_array($result)[0];
    }

    public static function checkIssetSerial($serial)
    {
        $conn = new mysqli(self::hn, self::un, self::pw, self::db,);
        if ($conn->connect_error) die("Fatal Error");
        $query = "SELECT EXISTS(SELECT * FROM hardware WHERE serial ='{$serial}')";
        $result = mysqli_fetch_array($conn->query($query))[0] ? true : false;
        $conn->close();
        return $result;
    }

    public static function writeHardware($idHardwareType, $arrSerials)
    {
        $errorSerials = [];
        $errors = 0;
        $succsess = 0;

        $conn = new mysqli(self::hn, self::un, self::pw, self::db,);
        if ($conn->connect_error) die("Fatal Error");

        $stmt = $conn->prepare('INSERT IGNORE INTO hardware VALUES(?,?,?)');
        foreach ($arrSerials as $serial) {
            if (self::checkIssetSerial($serial)) {
                $errors++;
                array_push($errorSerials, $serial);
            } else {
                $id = null;
                $type_id = $idHardwareType;
                $serial_number = $serial;

                $stmt->bind_param(
                    'iis',
                    $id,
                    $type_id,
                    $serial_number,
                );
                $stmt->execute();
                print_r($stmt->get_result());
                $succsess++;
            }
        }
        $stmt->close();
        $conn->close();
        return [
            'succsess' => $succsess,
            'errors' => $errors,
            'errorSerials' => $errorSerials
        ];
    }
}
