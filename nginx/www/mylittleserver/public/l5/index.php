<?php

function task1()
{
	$very_bad_unclear_name = "15 chicken wings";

	$order = &$very_bad_unclear_name;
	$order = $order . ' run';

	echo $very_bad_unclear_name;
}

function task2()
{
	$number = 3;
	$number_1 = 5;
	echo $number . '<br/>';
	echo $number_1 . '<br/>';
	$number_float = 3.5;
	echo $number_float . '<br/>';
	echo 11 + 1 . '<br/>';

	$last_month = 1187.23;
	$this_month = 1089.98;
}

function task11()
{
	$num_languages = 4;
	$months = 11;
	$days = $months * 16;
	$days_per_languages = $days / $num_languages;
	echo $days_per_languages;
}

function task12()
{
	echo 8**2;
}

function task13()
{
	$my_number = 4;
	$answer = $my_number;
	$answer += 2;
	$answer *= 2;
	$answer -= 2;
	$answer /= 2;
	$answer -= $my_number;
	echo $answer;
}

function task14()
{
	$a = 10;
	$b = 3;
	echo $a % $b . '<br/>';
	if ($a % $b > 0)
	{
		echo "Делится без остатка " . '<br/>';
	}
	else
	{
		echo "Делится с остатком " . $a % $b . '<br/>';
	}

	$st = 2**10;
	echo "2**10 = " . $st . '<br/>';
	$num_5 = sqrt(245);
	echo"sqrt(245) = " . $num_5 . '<br/>';
	$arr = array(4, 2, 5, 19, 13, 0, 10);
	$sum = 0;
	foreach ($arr as &$value)
	{
		$sum += ($value **2);
	}

	$answer_1 = sqrt($sum);
	echo $answer_1 . '<br/>';

	echo round(sqrt(379)) . " " . round(sqrt(379), 1) . ' ' . round(sqrt(379), 2) . '<br/>';

	echo floor(sqrt(587)) . " " . ceil(sqrt(587)) . '<br/>';

	$arr_1 = array(4, -2, 5, 19, -130, 0, 10);
	echo 'min = ' . min($arr_1) . " max = " . max($arr_1) . '<br/>';

	echo "rand = " . rand(1, 100) . '<br/>';
	$arr_2 = array();
	for ($i = 1; $i <= 10; $i++)
	{
		$arr_2[$i] = rand(1, 100);
	}

	echo "array rand = ";
	print_r($arr_2);
	print '<br/>';

	$a = 5;
	$b = 29;
	echo "abs(a-b) = " . abs($a - $b) . '<br/>';
	$arr_3 = array(1, 2, -1, -2, 3, -3);
	for ($i = 0; $i < 6; $i++)
	{
		$arr_3[$i] = abs($arr_3[$i]);
	}

	echo "array after abs = ";
	print_r($arr_3);
	print '<br/>';

	$a = 30;
	$arr_num = array();
	$y = 0;
	for ($i = 1; $i <= $a; ++$i)
	{
		if($a % $i == 0)
		{
			$arr_num[$y] = $i;
			$y += 1;
		}
	}

	echo "a % i == 0; i = ";
	print_r($arr_num);
	print '<br/>';

	$arr_4 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	$sum = 0;
	for ($i = 0; $i < 6; $i++)
	{
		if ($sum <= 10)
		{
			$sum += $arr_4[$i];
		}
		else
		{
			echo "Need first number = " . $i;
			break;
		}
	}

}

function task15()
{
	function printStringReturnNumber()
	{
		echo "new String" . '</br>';
		return 5;
	}

	$my_num = printStringReturnNumber();
	echo $my_num;
}

function task16()
{
	function increaseEnthusiasm($srting)
	{
		return $srting . '!';
	}

	echo increaseEnthusiasm('Hello') . '</br>';

	function repeatThreeTimes($string)
	{
		return $string . $string . $string;
	}

	echo increaseEnthusiasm(repeatThreeTimes('Hello')) . '</br>';

	function cut($string, $num = 10) {}

	function print_array($arr, $i)
	{
		echo $arr[$i]. " ";
		$i += 1;
		if ($i < count($arr))
		{
			print_array($arr, $i);
		}
	}

	$arr = array(1, 2, 3, 4, 5, 6);
	print_array($arr, 0);
	echo '</br>';

	$a = 12345;
	while($a > 10)
	{
		$b = $a;
		$sum = 0;
		while($b > 0)
		{
			$sum += ($b % 10);
			$b /= 10;
		}

		$a = $sum;
	}

	echo $a . '</br>';
}

function task17()
{

	$arr = array();
	for($i = 0; $i < 5; ++$i)
	{
		$arr[$i] = str_repeat('x', ($i + 1));
	}

	print_r($arr);
	echo '</br>';

	function arrayFill($string, $kol)
	{
		$arr = array();
		for ($i = 0; $i < $kol; ++$i)
		{
			$arr[$i] = $string;
		}

		return $arr;
	}

	$arr_1 = array();
	$arr_1 = arrayFill('x', 5);
	print_r($arr_1);
	echo '</br>';

	$arr_2 = array(array(1, 2, 3), array(4, 5), array(6));
	$sum = 0;
	for ($i = 0; $i < count($arr_2); ++$i)
	{
		for ($j = 0; $j < count($arr_2[$i]); ++$j)
		{
			$sum += $arr_2[$i][$j];
		}
	}

	echo $sum . '</br>';

	$arr_3 = array();
	for ($i = 0; $i < 3; ++$i)
	{
		for ($j = 1; $j <= 3; ++$j)
		{
			$arr_3[$i][$j] = $i * 3 + $j;
		}
	}

	print_r($arr_3);
	echo '</br>';

	$arr_4 = array(2, 5, 3, 9);
	$result = $arr_4[0] * $arr_4[1] + $arr_4[2] * $arr_4[3];
	echo $result . '</br>';


	$user = array("name" => array('Ivan', 'Ilia'),
		'surname' => array('Ivanov', 'Lobanov'),
		"patronymic" => array("Ivanovish", "Ivanoy"));

	for ($i = 0; $i < count($user['name']); ++$i)
	{
		echo $user['surname'][$i] . " " . $user['name'][$i] . " " . $user['patronymic'][$i] . '</br>';
	}

	$date = array('year' => 2022, 'month' => 11, 'day' => 29);
	echo $date['year'] . "-" . $date['month'] . "-" . $date['day'] . '</br>';

	$arr_5 = ['a', 'b', 'c', 'd', 'e'];
	echo count($arr_5) . '</br>';
	echo $arr_5[count($arr_5) - 1] . " " . $arr_5[count($arr_5) - 2];
}

function task18()
{
	function Bigger_10($a, $b)
	{
		if ($a + $b > 10)
		{
			return true;
		}
		return false;
	}

	function Equally_two_number($a, $b)
	{
		if ($a == $b)
		{
			return true;
		}
		return false;
	}

	$test = 0;
	echo ($test == 0 ? 'верно' . '</br>' : "");

	$age = 8;
	if ($age < 10 || $age > 99)
	{
		echo "Number is bigger 99 or smaller 10" . '</br>';
	}
	else {
		$sum = 0;
		while ($age > 0)
		{
			$sum += ($age % 10);
			$age /= 10;
		}
		if($sum <= 9)
		{
			echo "Sum number is 0 - 9" . '</br>';
		}
		else
		{
			echo "Sum number is 10 - 18" . '</br>';
		}
	}

	$arr = array(1, 2, 3, 4);
	if (count($arr) == 3)
	{
		$sum = 0;
		for ($i = 0; $i < count($arr); $i++)
		{
			$sum += $arr[$i];
		}

		echo "Sum = " . $sum . '</br>';
	}
	else
	{
		echo "Number in array is more 3" . '</br>';
	}
}

function task19()
{
	for ($i = 0; $i < 20; ++$i)
	{
		for($j = 0; $j < $i + 1; $j++)
		{
			echo "x";
		}
		echo '</br>';
	}
}

function task20()
{
	$arr = array(1, 2, 3, 4);
	$answer = array_sum($arr) / count(($arr));
	echo $answer . "</br>";

	$arr_1 = range(1, 100);
	$sum = array_sum($arr_1);
	echo $sum . "</br>";

	function sqrt_($i)
	{
		return ($i * $i);
	}

	$arr_2 = array_map('sqrt_', $arr);
	print_r($arr_2);
	echo '</br>';

	$arr_4 = range('a', 'z');
	print_r($arr_4);
	echo '</br>';

	$a = '1234567890';

	$num_1 = substr($a, 0, 2);
	$num_2 = substr($a, 2, 2);
	$num_3 = substr($a, 4, 2);
	$num_4 = substr($a, 6, 2);
	$num_5 = substr($a, 8, 2);

	echo $num_1 + $num_2 + $num_3 + $num_4 + $num_5;
}

?>