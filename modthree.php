<?php

use FSM\FSM;
use FSM\Alphabet;
use FSM\State;
use FSM\States;
use FSM\Transition;
use FSM\Transitions;

function modThree(String $input): int
{
    // Setup states
    $states = new States();
    $states->addState(new State('S0', 0));
    $states->addState(new State('S1', 1));
    $states->addState(new State('S2', 2));

    // Setup alphabet
    $alphabet = new Alphabet(['0', '1']);

    $transitions = new Transitions();
    // When S0 encounters '0', go to S0 (looping in S0 when 'S0' is 0)
    $transitions->addTransition(new Transition($states->getStateByName('S0'), '0', $states->getStateByName('S0')));
    // When S0 encounters '1', go to S1
    $transitions->addTransition(new Transition($states->getStateByName('S0'), '1', $states->getStateByName('S1')));
    // When S1 encounters '0', go to S2
    $transitions->addTransition(new Transition($states->getStateByName('S1'), '0', $states->getStateByName('S2')));
    // When S1 encounters '1', go to S0
    $transitions->addTransition(new Transition($states->getStateByName('S1'), '1', $states->getStateByName('S0')));
    // When S2 encounters '0', go to S1
    $transitions->addTransition(new Transition($states->getStateByName('S2'), '0', $states->getStateByName('S1')));
    // When S2 encounters '1', go to S2
    $transitions->addTransition(new Transition($states->getStateByName('S2'), '1', $states->getStateByName('S2')));

    // Setup FSM
    $fsm = new FSM($states, $alphabet, $states->getStateByName('S0'), $transitions);

    return  $fsm->getFinalState($input)->getValue();
}
