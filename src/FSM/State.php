<?php

namespace FSM;

class State
{
    private string $name;
    private int $value;

    /**
     * @param string $name Name of the state.
     * @param int $value Value associated with the state.
     */
    public function __construct(string $name, int $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Gets the name of the state.
     *
     * @return string Name of the state.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the value of the state.
     *
     * @return int Value of the state.
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
