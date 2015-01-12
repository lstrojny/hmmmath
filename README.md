# hmmmath

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/lstrojny/hmmmath?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/lstrojny/hmmmath.svg)](https://travis-ci.org/lstrojny/hmmmath) [![Dependency Status](https://www.versioneye.com/user/projects/523ed81c632bac1b1100c3bf/badge.png)](https://www.versioneye.com/user/projects/523ed81c632bac1b1100c3bf) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/lstrojny/hmmmath.svg)](http://isitmaintained.com/project/lstrojny/hmmmath "Average time to resolve an issue") [![Percentage of issues still open](http://isitmaintained.com/badge/open/lstrojny/hmmmath.svg)](http://isitmaintained.com/project/lstrojny/hmmmath "Percentage of issues still open")

Delicious math component for PHP


## Fibonacci number sequences

```php
<?php
use hmmmath\Fibonacci\FibonacciFactory;

foreach (FibonacciFactory::sequence(0, 1) as $number) {
    var_dump($number);
}
```

Will output:
```
int(0)
int(1)
int(1)
int(2)
int(3)
int(5)
int(8)
int(13)
int(21)
int(34)
int(55)
int(89)
int(144)
...
```
