<?php
/**
 * Created by PhpStorm.
 * User: evertonmuniz
 * Date: 11/02/18
 * Time: 18:02.
 */

namespace App\Service;

class CalculoTroco
{
    public static function calcula($valorCobrado, $valorPago)
    {
        if ($valorPago <= $valorCobrado) {
            return [
                'notas' => [],
                'moedas' => [],
            ];
        }

        $arrayNotas = [100, 50, 10, 5];
        $arrayMoedas = [100, 50, 10, 5, 1];

        $totalTroco = $valorPago - $valorCobrado;
        $totalTroco = round($totalTroco, 2);

        $arrayNotasTroco = [];
        $arrayMoedasTroco = [];
        $valorInteiro = (int) $totalTroco;
        $totalEmNotas = 0;

        foreach ($arrayNotas as $nota) {
            $result = $valorInteiro / $nota;

            if ($result >= 1) {
                $arrayNotasTroco[$nota] = (int) $result;
                $valorInteiro = $valorInteiro % $nota;
                $totalEmNotas += $nota * (int) $result;
            }
        }

        $valorRestante = (int) round((($totalTroco - $totalEmNotas) * 100));

        while ($valorRestante > 0) {
            foreach ($arrayMoedas as $moeda) {
                $result = round($valorRestante / $moeda, 2);
                if ($result >= 1) {
                    if ($moeda == 100) {
                        $moedaString = 1;
                    } else {
                        $moedaString = $moeda;
                    }
                    $arrayMoedasTroco[(string) $moedaString] = (int) $result;
                    $valorRestante = $valorRestante % $moeda;
                }
            }
        }

        return [
            'notas' => $arrayNotasTroco,
            'moedas' => $arrayMoedasTroco,
        ];
    }
}
