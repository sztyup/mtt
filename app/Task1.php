<?php

namespace App;

class Task1
{
    /**
     * @param array $array Input array
     * @param int $number Sum to be found
     *
     * @return array [subset begin index, subset end index], [-1, -1] if none found
     */
    public static function subset(array $array, int $number): array
    {
        $tempSum = 0;
        $lastIndex = 0;

        foreach ($array as $index => $value) {
            $tempSum += $value;
            if ($tempSum === $number) {
                return [$lastIndex, $index];
            }

            if ($tempSum > $number) {
                $tempSum = 0;
                $lastIndex = $index + 1;
            }
        }

        return [-1, -1];
    }

    /**
     * @param string $string The string to be decided
     *
     * @return bool Whether the string is palindrom or not
     */
    public static function palindrom(string $string): bool
    {
        $string = preg_replace('/[^a-záíűőüöúóé0-9]/u', '', mb_strtolower($string));
        $chars = str_split($string);
        $length = count($chars);

        for ($index = 0; $index < $length / 2; $index++) {
            if ($chars[$index] !== $chars[$length - $index - 1]) {
                return false;
            }
        }

        return true;
    }

    public static function paranthesis(string $string): string
    {
        $chars = str_split($string);
        static $map = [
            '(' => ')',
            '[' => ']',
            '{' => '}',
        ];
        $stack = [];

        foreach ($chars as $index => $char) {
            // new group starts
            if (array_key_exists($char, $map)) {
                $stack[] = $char;
            }

            $id = array_search($char, $map, true);
            if ($id !== false && $id !== array_pop($stack)) {
                return 'false - hibás index: ' . $index;
            }
        }

        if (!empty($stack)) {
            return 'false - lezáratlan zárójel(ek): ' . implode($stack);
        }

        return 'true';
    }
}
