<?php

class VNWorkWithMatrix
{
    /**
     * @var null
     * Хранит экземпляр класса
     */
    private static $_instance = null;

    /**
     * @return null
     * Возаращает экземпляр класса
     */
    public static function GetInstance()
    {
        if (is_null(VNWorkWithMatrix::$_instance)) VNWorkWithMatrix::$_instance = new VNWorkWithMatrix();
        return VNWorkWithMatrix::$_instance;
    }

    public function toStepMatrix($matrix)
    {
        $curr_i = 0;
        $curr_j = 0;
        /**
         * Примерный алгоритм для реализации:
         * (пока Матрица не является ступенчатой){
         *      выбираем ведущий элемент в подматрице исходной матрицы [curr_i - sizeof($matrix)][curr_j - sizeof($matrix)]
         *      если строка с ведущим элементом делится на него нацело, то делим
         *      преобразуем элементы под ведущим элементом к 0
         * }
         */

        var_dump($this->isStepMatrix($matrix));
    }

    /**
     * @param $matrix
     * @return bool
     * Проверяет, является ли матрица ступенчатой
     * Матрица является ступенчатой, если:
     * 1. Если она содержит нулевую строку, то все строки ниже тоже нулевые
     * 2. Если первый ненулевой элемент i-той строки находится в j-том столбце,
     *      то первый ненулевой элемент i+1-той строки должен находиться не раньше, чем
     *      в j+1 столбце
     */
    private function isStepMatrix($matrix)
    {
        $haveNullRow = false;
        $first_not_null = -1;

        foreach ($matrix as $row) {
            if (!$this->isNullRowOfMatrix($row) && $haveNullRow) {
                return false;
            }

            if ($this->isNullRowOfMatrix($row)) {
                $haveNullRow = true;
            } else {
                $temp_first_not_null = $this->GetFirstNotNullElement($row);

                if ($temp_first_not_null <= $first_not_null) {
                    return false;
                }

                $first_not_null = $temp_first_not_null;

            }
        }

        return true;
    }

    /**
     * @param $row
     * @return bool
     * Проверяет, является ли строка матрицы нулевой
     */
    private function isNullRowOfMatrix($row)
    {
        foreach ($row as $item) {
            if ($item !== 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $row
     * @return bool|int|string
     * Возвращает первый ненулевой элемент строки
     */
    private function GetFirstNotNullElement($row)
    {
        foreach ($row as $number => $item) {
            if ($item !== 0) {
                return $number;
            }
        }

        return false;
    }
}

$matrix = [
    [1, 2, 3, 0, 0],
    [0, 2, 3, 0, 0],
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0]
];

$matrix_check = VNWorkWithMatrix::GetInstance();
$matrix_check->toStepMatrix($matrix);