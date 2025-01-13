<?php

namespace FSM;

use InvalidArgumentException;
use RuntimeException;

class FSM
{
    private Alphabet $alphabet;  // Alphabet of symbols the FSM can process
    private States $states;  // Set of states
    private State $currentState;  // Current state
    private Transitions $transitions; // Set of transitions

    private $onStateChangeCallback;   // Callback for each state change
    private $onCompletionCallback;    // Callback when all symbols are processed

    /**
     * Initializes the FSM with a set of states, an alphabet, and an initial state.
     *
     * @param States $states Set of states.
     * @param Alphabet $alphabet Set of symbols.
     * @param State $initialState Initial state.
     * @param Transitions $transitions Set of transitions.
     * @param callable|null $onStateChangeCallback Callback for state changes - not required.
     * @param callable|null $onCompletionCallback Callback when processing is complete - not required.
     * @throws InvalidArgumentException If the initial state is not part of the set of states.
     */
    public function __construct(
        States $states,
        Alphabet $alphabet,
        State $initialState,
        Transitions $transitions,
        ?callable $onStateChangeCallback = null,
        ?callable $onCompletionCallback = null
    ) {
        if (!$states->hasState($initialState)) {
            throw new InvalidArgumentException('Invalid initial state.');
        }

        $this->states = $states;
        $this->transitions = $transitions;
        $this->alphabet = $alphabet;
        $this->currentState = $initialState;

        $this->onStateChangeCallback = $onStateChangeCallback;
        $this->onCompletionCallback = $onCompletionCallback;
    }

    /**
     * Processes a symbol and transitions to the next state.
     *
     * @param string $symbol Symbol to process.
     * @return State Resulting state after processing the symbol.
     * @throws InvalidArgumentException If the symbol is invalid.
     * @throws RuntimeException If there is no transition defined for the current state and symbol.
     */
    public function processSymbol(string $symbol): State
    {
        // Check if the symbol is valid in the alphabet
        if (!$this->alphabet->hasSymbol($symbol)) {
            throw new InvalidArgumentException("Invalid symbol: {$symbol}");
        }

        // Execute the onStateChange callback
        if ($this->onStateChangeCallback) {
            call_user_func($this->onStateChangeCallback, $this->currentState, $newState, $symbol);
        }

        $this->currentState = $this->transitions->applyTransition($this->currentState, $symbol);
        return $this->currentState;
    }

    /**
     * Processes a string of symbols and applies all the corresponding transitions.
     *
     * @param string $inputString String of symbols to process.
     * @return State Final state after processing all symbols.
     */
    public function processAllSymbols(string $inputString): State
    {
        // Loop through each character in the input string
        // The 'for' loop with 'strlen' is used instead of 'str_split' with 'foreach' or 'ArrayIterator'
        // because it is more efficient. It doesn't create an extra array like 'str_split' does.
        // Using 'strlen' allows accessing the string directly without extra memory usage, which is better for performance.
        // The test was made to compare this way with others (like 'foreach' with 'str_split' or 'ArrayIterator')
        // and the results can be accessed runing the file 'tests/benchmark.php'. It shows the performance difference in big strings.
        for ($i = 0, $len = strlen($inputString); $i < $len; $i++) {
            $this->processSymbol($inputString[$i]);
        }

        // Execute onCompletion callback
        if ($this->onCompletionCallback) {
            call_user_func($this->onCompletionCallback, $this->currentState);
        }

        return $this->currentState;
    }

    /**
     * Gets the current state.
     *
     * @return State Current state.
     */
    public function getCurrentState(): State
    {
        return $this->currentState;
    }


    /**
     * Gets the final state.
     *
     * @return State Current state.
     */
    public function getFinalState(string $inputString): State
    {
        $this->processAllSymbols($inputString);
        return $this->currentState;
    }
}
