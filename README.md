# The FreeBaseNumber class
(PHP 7)

## Introduction
FreeBaseNumber should be used to create and work with a number of the free numeral system and charset.

## Class synopsis
```php
FreeBaseNumber{
  
  /* Methods */
  public __construct([ array $availableChars = null [, int|string $initValue = null]]) : Object
  public getVal() : string
  public incVal([int $step = 1]) : string
}
```

## Methods
*__construct($availableChars $initValue)* - creates a class instance with an initial value *$initValue* and a charset *$availableChars*.<br>
*getVal()* - returns a number current value.<br>
*incVal($step)* - increments a number by *step* and returns a number incremented value.

## Examples
### Example #1 A decimal number
```php
$num = new FreeBaseNumber();
echo $num->getVal();                      //0
echo $num->incVal();                      //1
echo $num->incVal(18);                    //19

$chars = range(0, 9);
$num = new FreeBaseNumber($chars, 20);
echo $num->getVal();                      //20
echo $num->incVal(29);                    //49
```

### Example #2 A free-base number
```php
$chars = range(0, 7);                     //[0, 1, 2, 3, 4, 5, 6, 7]
$num = new FreeBaseNumber($chars, 0);
echo $num->getVal();                      //0
echo $num->incVal(10);                    //12

$chars = array_merge(
  range(2, 5),
  ['!'],
  range('a', 'c'),
  ['#', '.']
);                                        //[2, 3, 4, 5, '!', 'a', 'b', 'c', '#', '.']
$num = new FreeBaseNumber($chars, '2#c');
echo $num->getVal();                      //2#c
echo $num->incVal(55);                    //3!4
```
## Example #3 A class FreeBasePass extends FreeBaseNumber
```php
$chars = array_merge(range(0, 9));

    $num = new FreeBaseNumber($chars);
    echo $num->getVal();
    for($i = 1; $i < 15; $i++){
        echo ' ' . $num->incVal();
    }                                     //0 1 2 3 4 5 6 7 8 9 10 11 12 13 14

    echo '<br>';
    
    $pass = new FreeBasePass($chars);
    echo $pass->getVal();
    for($i = 1; $i < 15; $i++){
        echo ' ' . $pass->incVal();
    }                                     //0 1 2 3 4 5 6 7 8 9 00 01 02 03 04
```

### Example #4 A hash decoder
```php
$hash = sha1('9G8a');

$chars = array_merge(range(0, 9), range('A', 'z'));
$pass = new FreeBasePass($chars);

while(sha1($pass->getVal()) !== $hash){
    $pass->incVal();
}

echo 'HASH: ' . $hash . '<br>';      //HASH: 2947b1700c60173ef4da345b2e46641c91168984
echo 'PASS: ' . $pass->getVal();     //PASS: 9G8a
```
