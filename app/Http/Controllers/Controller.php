<?php

namespace App\Http\Controllers;

use App\Models\Users;

abstract class Controller
{
    function isEmail($string){
        return filter_var($string, FILTER_VALIDATE_EMAIL) !== false;
    }

    function isCPF($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    function isCNPJ($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) != 14) {
            return false;
        }
        $calculation = function ($cnpj, $multiplier) {
            $sum = 0;
            for ($i = 0, $j = $multiplier; $i < strlen($cnpj); $i++, $j--) {
                $sum += $cnpj[$i] * $j;
                if ($j < 3) {
                    $j = 9;
                }
            }
            return $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
        };

        $firstVerifier = $calculation(substr($cnpj, 0, 12), 5);
        $secondVerifier = $calculation(substr($cnpj, 0, 13), 6);

        return $firstVerifier == $cnpj[12] && $secondVerifier == $cnpj[13];
    }

    public function ReaisToFloat(string $value){
        $valor = str_replace(',', '.', $value);
        $valor = str_replace('.', '', $valor);
        return $valor;
    }

}
