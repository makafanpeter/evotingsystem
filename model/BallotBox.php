<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BallotBox
 *
 * @author Peter
 */
class BallotBox {

    //put your code here
    /**
     *
     * @var array
     */
    private $items;

    /**
     *
     * @var int
     */
    private $numberOfItems;

    public function __construct() {
        $this->items = array();
        $this->numberOfItems = 0;
    }

    /**
     * add candidate to ballotbox
     * @param Candidate $candidate
     */
    public function addItem(Candidate $candidate) {
        if (array_key_exists($candidate->getPosition(), $this->items)) {
            $this->items[$candidate->getPosition()] = $candidate;
        } else {
            $this->items[$candidate->getPosition()] = clone $candidate;
            ++$this->numberOfItems;
        }
    }

    /**
     * 
     * @return BallotBox
     */
    public function getBallotBox() {
        array_multisort(array_keys($this->items), $this->items);
        return $this->items;
    }

    /**
     * 
     * @param Candidate $candidate
     * remove a candidate from ballotbox
     */
    public function removeItem(Candidate $candidate) {
        if (!$this->isEmpty()) {
            unset($this->items[$candidate->getPosition()]);
            $this->numberOfItems--;
        }
    }

    /**
     * clears ballotbox
     */
    public function clear() {
        $this->items = array();
        $this->numberOfItems = 0;
    }

    /**
     *
     * @return int number of items in ballotBox
     */
    public function getNumberOfItems() {
        return $this->numberOfItems;
    }

    /**
     * @return boolean 
     */
    public function isEmpty() {
        return (count($this->items) == 0);
    }

}

?>