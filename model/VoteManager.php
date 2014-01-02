<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vote
 *
 * @author Peter
 */
class VoteManager {

    //put your code here
    public function __construct() {
        
    }

    public static function vote(BallotBox $ballotbox) {
        if (!$ballotbox->isEmpty()) {
            self::addVote($ballotbox);
        }
    }

    private static function addVote(BallotBox $bollotBox) {
        $resultdao = new ResultDao();
        $items = $bollotBox->getBallotBox();
        foreach ($items as $candidate) {
            $resultdao->save($candidate);
        }
    }

}

?>
