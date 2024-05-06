**To explain [test doubles in PHPUnit] by using various examples.**

For details, please read the source code under folder [./unit] and run the tests using PHPUnit.

## Usage

First, run the following command to install/update Composer packages:

```bash
composer update -n
```

Now we can run PHPUnit tests:

```bash
./vendor/bin/phpunit
```

## Version Matrix

Following table shows the versions of PHP and PHPUnit used to run the tests of this project via GitHub Actions:

| PHP Versions | PHPUnit Versions |
|--------------|------------------|
| PHP 7.3      | PHPUnit 9        |
| PHP 7.4      | PHPUnit 9        |
| PHP 8.0      | PHPUnit 9        |
| PHP 8.1      | PHPUnit 10       |
| PHP 8.2      | PHPUnit 11       |
| PHP 8.3      | PHPUnit 11       |

## References

* [test doubles in PHPUnit]: The official documentation.
* [StackOverflow: Mocks vs Stubs in PHPUnit]: Effective comparison of dummies, stubs, mocks, and spies in PHPUnit, although  the examples are outdated.

[test doubles in PHPUnit]: https://docs.phpunit.de/en/9.6/test-doubles.html
[StackOverflow: Mocks vs Stubs in PHPUnit]: https://stackoverflow.com/a/45975572
[./unit]: https://github.com/deminy/test-doubles-explained/tree/master/unit
