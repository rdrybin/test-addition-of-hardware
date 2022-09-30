<?php
class MaskValidator
{
    private $regExp;

    private $validArr;

    private $notValidArr;


    function __construct($mask)
    {
        /* N – цифра от 0 до 9,
        A – прописная буква латинского алфавита,
        a – строчная буква латинского алфавита,
        X – прописная буква латинского алфавита либо цифра от 0 до 9,
        Z –символ из списка: “-“, “_”, “@”.
            XXAAAAAXAA
                91SDFGCABB
                DDDDDDDDDD
            NXXAAXZXaa
                777SD9@9as
                777SD9-Aas
                777SD9_7as
            NXXAAXZXXX
                7ASDFG-AAA
                7AAAAA@AAA
                7AAAAA_AAA
                7AAAAA-998
        */

        $mask =  str_split($mask);
        $regExp = [];
        foreach ($mask as $e) {
            switch ($e) {
                case 'N':
                    array_push($regExp, '[\d]');
                    break 1;
                case 'A':
                    array_push($regExp, '[A-Z]');
                    break 1;
                case 'a':
                    array_push($regExp, '[a-z]');
                    break 1;
                case 'X':
                    array_push($regExp, '[A-Z0-9]');
                    break 1;
                case 'Z':
                    array_push($regExp, '(-|_|@)');
                    break 1;
                default:
                    return false;
            }
        }
        $this->regExp =  '/^' . implode($regExp) . '$/';
    }

    public function getRegExp()
    {
        return $this->regExp;
    }
    public function getValid()
    {
        return $this->validArr;
    }
    public function getNotValid()
    {
        return $this->notValidArr;
    }

    public function validateArr($arrValues)
    {
        $valid = [];
        $notValid = [];
        foreach ($arrValues as $value) {
            if (preg_match($this->regExp, $value)) {
                array_push($valid, $value);
            } else {
                array_push($notValid, $value);
            }
        }
        $this->validArr = $valid;
        $this->notValidArr = $notValid;
    }
}
