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
        $curr_matrix = $matrix;
        $host_item = null;
        /**
         * Примерный алгоритм для реализации:
         * (пока Матрица не является ступенчатой){
         *      выбираем ведущий элемент в подматрице исходной матрицы [curr_i - sizeof($matrix)][curr_j - sizeof($matrix)]
         *      если строка с ведущим элементом делится на него нацело, то делим
         *      преобразуем элементы под ведущим элементом к 0
         * }
         */

        $this->printMatrix($curr_matrix, 'Исходная матрица');

        $host_item = $this->getHostItem($curr_matrix);
        if ($host_item !== 0) {
            $curr_matrix = $this->changeRowsOfMatrix($curr_matrix, 0, $host_item);
        }

        $this->printMatrix($curr_matrix, 'Поставила ведущий элемент первым');


//        while ($this->isStepMatrix($matrix)) {
//            //todo: приводим матрицу к ступенчатому виду
//        }
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

    /**
     * @param $matrix
     * @return bool|int|string
     * Находим ненулевой элемент в первом столбце переданной матрицы
     * Если в столбце все элементы нулевые - возвращаем false
     */
    private function getHostItem($matrix)
    {
        foreach ($matrix as $key => $row) {
            if ($row[0] !== 0) {
                return $key;
            }
        }

        return false;

    }

    /**
     * @param $matrix
     * @param $row1
     * @param $row2
     * @return mixed
     * Меняем местами две строки в матрице, нумерация начинается с 0
     */
    private function changeRowsOfMatrix($matrix, $row1, $row2)
    {
        $temp_row = $matrix[$row1];
        $matrix[$row1] = $matrix[$row2];
        $matrix[$row2] = $temp_row;

        return $matrix;
    }

    /**
     * @param $matrix
     * @param $title
     * Распечатываем матрицу в таблице html,
     * предварительно размещаем заголовок, переданный в $title
     */
    private function printMatrix($matrix, $title)
    {
        ?>
        <h1><?php echo $title; ?></h1>
        <table style="text-align: center;">
            <?php foreach ($matrix as $row): ?>
                <tr>
                    <?php foreach ($row as $item): ?>
                        <td style="width: 30px;">
                            <?php echo $item ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
    }
}

$matrix = [
    [0, 2, 3, 5, 10],
    [0, 2, 3, 2, 0],
    [0, 4, 14, 3, 3],
    [10, 13, 15, 9, 0]
];

$matrix_check = VNWorkWithMatrix::GetInstance();
$matrix_check->toStepMatrix($matrix);