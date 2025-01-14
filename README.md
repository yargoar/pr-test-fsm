# P.R. FSM Library - Test for Full Stack Software Developer III position

This project is built as part of a test for Full Stack Software Developer III position in the P.R.

It is a Finite State Machine (FSM) library implemented in PHP. The library do the creation and processing of finite state machines with states and transitions.

## Features

- Defines states, symbols, and transitions for the FSM.
- Allows processing of input strings to transition through states.
- Includes a modular approach with different classes for managing states, symbols, transitions, and FSM logic permiting other developers can extend classes and making it more powerfull.
- PHPUnit tests for validating the FSM logic.

## How to run the project

Locally hosting the repository and running a page to see it working.

```bash
git clone https://github.com/yargoar/pr-test-fsm.git
cd pr-test-fsm
composer install
php -S localhost:8000
```

## Testing

As requested I implemented the modThree procedure in the file
You can run the tests using PHPUnit. Make sure you have PHPUnit installed and then run the following command:

```bash
vendor/bin/phpunit .\tests\FSMmodThreeTests.php
```

## Benchmarking

During the coding process, a question came up about the best approach for character iteration in terms of performance. So, I decided to run some tests and share with the team as a proof of concept.
A benchmarking file (`tests/benchmark.php`) is included to compare different methods of processing the input string:

- `array_map`
- Simple iteration with `str_split`
- `ArrayIterator`
- `for` loop with direct string access

You can run the benchmark script as follows:

```bash
php tests/benchmark.php
```

## Usage Example

Here is a practical example showing how to create and configure a finite state machine using this library:

```bash
use FSM\FSM;
use FSM\State;
use FSM\States;
use FSM\Alphabet;
use FSM\Transition;
use FSM\Transitions;

// Define states
$states = new States([
    new State('S0', 0),
    new State('S1', 1),
    new State('S2', 2),
]);

// Define alphabet
$alphabet = new Alphabet(['0', '1']);

// Define transitions
$transitions = new Transitions();
$transitions->addTransition(new Transition($states->getStateByName('S0'), '1', $states->getStateByName('S1')));
$transitions->addTransition(new Transition($states->getStateByName('S1'), '0', $states->getStateByName('S2')));
$transitions->addTransition(new Transition($states->getStateByName('S2'), '1', $states->getStateByName('S0')));

// Create the FSM
$fsm = new FSM($states, $alphabet, $states->getStateByName('S0'), $transitions);

// Process symbols
$fsm->processAllSymbols('1101');
echo $fsm->getCurrentState()->getName();  // Output: S1
```

## How to Expand the FSM Library

The library was designed to be modular and extensible. Here are some ways developers can expand its functionality:

:heavy_check_mark: Adding New Types of Transitions

For more complex scenarios, additional states can be defined by creating classes subclasses of the State.

:heavy_check_mark: Adding Custom Validation

The FSM class can be extended to include custom input validations or processing.

:heavy_check_mark: Adding Custom Callbacks

The FSM supports callbacks for state change and complete processing of an input. This can be used for a big variety of custom logic.

```bash
$fsm = new FSM(
    $states,
    $alphabet,
    $states->getStateByName('S0'),
    $transitions,
    function ($currentState, $newState, $symbol) {
        echo "Transitioned from {$currentState->getName()} to {$newState->getName()} with symbol '{$symbol}'\n";
    },
    function ($finalState) {
        echo "Processing completed. Final state: {$finalState->getName()}\n";
    }
);
```
