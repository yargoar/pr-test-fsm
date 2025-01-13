<?php

namespace FSM;

use RuntimeException;

/**
 * The Transitions class manages state transitions.
 */
class Transitions
{
    private array $transitions = [];

    /**
     * Check if the array have only Transition objects and adds them to the transitions collection.
     *
     * @param array $transitions Array of Transition objects.
     * @throws InvalidArgumentException If any element in the array is not a Transition instance.
     */
    public function __construct(array $transitions = [])
    {
        foreach ($transitions as $transition) {
            if (!$transition instanceof Transition) {
                throw new InvalidArgumentException("Elements must be instances of Transition.");
            }
            $this->addTransition($transition);
        }
    }

    /**
     * Adds a new transition to the transitions list.
     *
     * @param Transition $transition Transition to be added.
     */
    public function addTransition(Transition $transition): void
    {
        // Get the source state name and the triggering symbol
        $source = $transition->getSourceState()->getName();
        $symbol = $transition->getSymbol();

        // Store the transition in a nested associative array
        $this->transitions[$source][$symbol] = $transition;
    }

    /**
     * Returns a transition based in the current state and symbol.
     *
     * @param State $state Current state.
     * @param string $symbol Symbol to be processed.
     * @return Transition|null Corresponding transition if it exists or null when it is not found.
     */
    public function getTransition(State $state, string $symbol): ?Transition
    {
        // Retrieve the transition from the nested array using the state name and symbol
        $stateName = $state->getName();
        return $this->transitions[$stateName][$symbol] ?? null;
    }

    /**
     * Based on the current state apply a transition according the input symbol.
     * If transition is valid returns next state.
     * If transition is not found, it throws a RuntimeException.
     *
     * @param State $state Current state.
     * @param string $symbol Input symbol to be processed.
     * @return State State after applying the transition.
     * @throws RuntimeException If there is no valid transition for passed state and symbol.
     */
    public function applyTransition(State $state, string $symbol): State
    {
        $transition = $this->getTransition($state, $symbol);

        // If no transition is found throws an exception
        if (!$transition) {
            throw new RuntimeException("No transition defined for state {$state->getName()} with symbol {$symbol}");
        }

        // Return the transition target state
        return $transition->getTargetState();
    }
}
