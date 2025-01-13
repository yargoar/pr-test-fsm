<?php

namespace FSM;

class States
{
    private array $states = [];

    /**
    * Accepts an array of State and add them to the collection.
    *
    * @param array $states Array of State objects.
    * @throws InvalidArgumentException If any element in the array is not a State instance.
    */
    public function __construct(array $states = [])
    {
        foreach ($states as $state) {
            if (!$state instanceof State) {
                throw new InvalidArgumentException("All elements must be instances of State.");
            }
            $this->addState($state);
        }
    }

    /**
     * Adds a state to the collection of states.
     *
     * @param State $state The state to add.
     */
    public function addState(State $state): void
    {
        $this->states[$state->getName()] = $state;
    }

    /**
     * Checks if a given state exists in the collection.
     *
     * @param State $state State to check.
     * @return bool True if the state exists false if state does not exist.
     */
    public function hasState(State $state): bool
    {
        return isset($this->states[$state->getName()]);
    }

    /**
     * Returns a state by the name.
     *
     * @param string $name Name of the state to retrieve.
     * @return State|null State if found or null if State is not found by name.
     */
    public function getStateByName(string $name): ?State
    {
        return $this->states[$name] ?? null;
    }
}
