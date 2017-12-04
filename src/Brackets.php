<?php

class Brackets
{
    public function solution($bracketString)
    {
        $bracketString = trim($bracketString);

        // terminate early if it is obvious there are unmatched pairs
        if (1 === (strlen($bracketString) % 2)) return 0;

        $pairMap = [
            ']' => '[',
            '}' => '{',
            ')' => '(',
        ];

        $openingBrackets = array_values($pairMap);

        // str_split returns an array with a single element even if the string is empty
        if (!empty($bracketString)) {
            $bracketArray = str_split($bracketString);

            $stack = [];
            foreach ($bracketArray as $currentCharacter) {
                if (in_array($currentCharacter, $openingBrackets, true)) {
                    $stack[] = $currentCharacter;
                } else {
                    // if this is a closing bracket without a corresponding opening bracket
                    if (0 === count($stack)) return 0;

                    $last = array_pop($stack);

                    // if the order of brackets is mixed up
                    if ($pairMap[$currentCharacter] !== $last) {
                        return 0;
                    }
                }
            }

            // if unmatched brackets are left over
            if (!empty($stack)) {
                return 0;
            }
        }

        return 1;
    }
}
