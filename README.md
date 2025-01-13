# P.R. FSM Library - Test for Full Stack Software Developer III position

This project is built as part of a test for Full Stack Software Developer III position in the P.R.

It is a Finite State Machine (FSM) library implemented in PHP. The library do the creation and processing of finite state machines with states and transitions.

## Features

- Defines states, symbols, and transitions for the FSM.
- Allows processing of input strings to transition through states.
- Includes a modular approach with different classes for managing states, symbols, transitions, and FSM logic permiting other developers can extend classes and making it more powerfull.
- PHPUnit tests for validating the FSM logic.

## Benchmarking

During the coding process, a question came up about the best approach for character iteration in terms of performance. So, I decided to run some tests and share with the team as a proof of concept.
A benchmarking script (`benchmark.php`) is included to compare different methods of processing the input string:

- `array_map`
- Simple iteration with `str_split`
- `ArrayIterator`
- `for` loop with direct string access

You can run the benchmark script as follows:

```bash
php benchmark.php
```

## Testing

As requested I implemented the modThree procedure in the file
You can run the tests using PHPUnit. Make sure you have PHPUnit installed and then run the following command:

```bash
vendor/bin/phpunit .\tests\FSMmodThreeTests.php
```
