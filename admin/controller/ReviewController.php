<?php

include_once __DIR__. '/../model/Review.php';

class ReviewController extends Review {

    public function getReviews(){
        return $this->getReviewList();
    }

    public function deleteReview($id){
        return $this->deleteReviewInfo($id);
    }
}

?>