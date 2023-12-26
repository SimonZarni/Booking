<?php

include_once __DIR__. '/../model/Category.php';

class CategoryController extends Category {

    public function getCategories(){
        return $this->getCategoryInfo();
    }

    public function createCategory($name){
        return $this->addCategory($name);
    }

    public function getCategoryById($id){
        return $this->getCategoryList($id);
    }

    public function editCategory($id,$name){
        return $this->updateCategoryInfo($id,$name);
    }

    public function deleteCategory($id){
        return $this->deleteCategoryInfo($id);
    }
}

?>