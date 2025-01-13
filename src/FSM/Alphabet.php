<?php

namespace FSM;

class Alphabet
{
    private array $symbols;

    /**
     * @param array $symbols Array of symbols that in the alphabet.
     */
    public function __construct(array $symbols)
    {
        $this->symbols = $symbols;
    }

    /**
     * Checks if a given symbol is in the alphabet.
     *
     * @param string $symbol Symbol to check.
     * @return bool True if the symbol exists in the alphabet or no.
     */
    public function hasSymbol(string $symbol): bool
    {
        return in_array($symbol, $this->symbols, true);
    }
}
