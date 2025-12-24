<?php
include '../../Models/category_model.php';

class CategoryController
{
    private CategoryModel $categoryModel;

    public function __construct(PDO $conn)
    {
        $this->categoryModel = new CategoryModel($conn);

    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();
        include '../../Views/client/sidebarComponent.php';
    }
}

?>