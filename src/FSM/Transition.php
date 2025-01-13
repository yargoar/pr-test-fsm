<?php

namespace FSM;

use InvalidArgumentException;

class Transition
{
    private State $sourceState;  // State from the transition originates
    private State $targetState;  // State to the transition leads
    private string $symbol;  // Symbol that triggers the transition

    /**
     * @param State $sourceState The state from which the transition starts.
     * @param string $symbol The symbol that triggers the transition.
     * @param State $targetState The state to which the transition leads.
     * @throws InvalidArgumentException If any argument is null.
     */
    public function __construct(State $sourceState, string $symbol, State $targetState)
    {
        // Check if any argument is null
        if (is_null($sourceState) || is_null($symbol) || is_null($targetState)) {
            throw new InvalidArgumentException("State cannot receive null arguments.");
        }

        $this->sourceState = $sourceState;
        $this->targetState = $targetState;
        $this->symbol = $symbol;
    }

    /**
     * Gets the source state of the transition.
     *
     * @return State Source state.
     */
    public function getSourceState(): State
    {
        return $this->sourceState;
    }

    /**
     * Gets the target state of the transition.
     *
     * @return State Target state.
     */
    public function getTargetState(): State
    {
        return $this->targetState;
    }

    /**
     * Gets the symbol that triggers the transition.
     *
     * @return string Symbol that triggers the transition.
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
