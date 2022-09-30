<?php
class InterfaceElemets
{

    public static function printTypeSelectOptions()
    {
        $hardwareTypes = DBOperations::getHardwareType(['id', 'name']);
        foreach ($hardwareTypes as $hardwareType) {
            echo '<option  value="' . $hardwareType['id'] . '">' . $hardwareType['name'] . '</option>"';
        }
    }

    public static function printLogMessage($printData)
    {
        echo '<div class="alert alert-success alert-dismissible mt-4" role="alert">';
        echo  "Добавлено в БД: {$printData['succsess']} <br>";
        if (count($printData['errorSerials']) > 0) {
            $stringDuplicatedSerials =  join(", ", $printData['errorSerials']);
            echo  "Уже есть в БД: $stringDuplicatedSerials <br>";
        }
        if (count($printData['notValidated']) > 0) {
            $stringNotValidSerials =  join(", ", $printData['notValidated']);
            echo  "Не прошли валидацию:  $stringNotValidSerials <br>";
        }

        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}
