# The FreeBaseNumber class
(PHP 7)

## Introduction
FreeBaseNumber should be used to create and work with a number of the free numeral system and charset.

## Class synopsis
```php
FreeBaseNumber{

  /* Properties */
  private array $availableChars;
  private int $base;
  private array $valueDigitIds;
  
  /* Methods */
  public __construct([int $initValue = 0[, $array availableChars = false]]) : Object
  public getVal() : string
  public incVal([int $step = 1]) : string
  private incDigit(int $digitId, int $step) : void
}
```

## Properties
*availableChars* - an available charset for number creating.<br>
*base* - a base of the class instance.<br>
*valueDigitIds* - a value digits, represented as a *availableChars* array indexies.

## Methods
*__construct($initValue = 0, $availableChars = false)* - creates a class instance.<br>
*getVal()* - returns a number current value.<br>
*incVal($step = 1)* - increments a number by *step* and returns a number incremented value.<br>
*incDigit($digitId, $step)* - increments a number digit with index *digitId* by *step* and check if the current digit doesn't exceed a max limit.

## Examples
### Example #1 A decimal number
```php
$num = new FreeBaseNumber()
echo $num->getVal();                      //0
echo $num->incVal();                      //1
echo $num->incVal(18);                    //19

$num = new FreeBaseNumber(20)
echo $num->getVal();                      //20
echo $num->incVal(29);                    //49
```

### Example #2 A free-base number
```php
$chars = range(0, 7);                     //[0, 1, 2, 3, 4, 5, 6, 7]
$num = new FreeBaseNumber(0, $chars);
echo $num->getVal();                      //0
echo $num->incVal(10);                    //012

$chars = array_merge(
  range(2, 5),
  ['!'],
  range('a', 'c'),
  ['#', '.']
);                                        //[2, 3, 4, 5, '!', 'a', 'b', 'c', '#', '.']
$num = new FreeBaseNumber('2#c', $chars);
echo $num->getVal();                      //2#c
echo $num->incVal(55);                    //3!4
```

### Example #3 A hash decoder
```php
$hash = sha1('9G8a');

$chars = array_merge(range(0, 9), range('A', 'z'));
$pass = new FreeBaseNumber(0, $chars);

while(sha1($pass->getVal()) !== $hash){
    $pass->incVal();
}

echo 'A hash is: ' . $hash . '<br>';      //A hash is: 2947b1700c60173ef4da345b2e46641c91168984
echo 'A pass is: ' . $pass->getVal();     //A pass is: 9G8a
```
