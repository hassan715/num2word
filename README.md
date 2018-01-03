# num2word
This is a PHP library that allows you to convert numbers to words.

## Usage
This library currently supports one type of transformation. In order to use this transformation for certain language you need to create an instance of `NumToWord` class and then call `spellOut` method.

```php
use num2word\NumToWord;

$num2word = new NumToWord();
$num2word->spellOut('10305'); // output "ten thousand and three hundred five"
```
