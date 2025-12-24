<?php
include __DIR__ . '/../Models/product_model.php';
include __DIR__ . '/../Models/category_model.php';


class ProductController
{
    private ProductModel $productModel;
    private CategoryModel $categoryModel;

    public function __construct(PDO $conn)
    {
        $this->productModel = new ProductModel($conn);
        $this->categoryModel = new CategoryModel($conn);

    }

    public function index()
{
    $categories = $this->categoryModel->getAll();

    $category_id = $_GET['category_id'] ?? 'all';

    if (!empty($keyword)) {
        // 🔍 SEARCH THEO TÊN
        $products = $this->productModel->searchByName($keyword);
    } else {
        if ($category_id === 'all') {
            $products = $this->productModel->getAll();
        } else {
            $products = $this->productModel->getByCategory((int)$category_id);
        }
    }

    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 1) {
        include __DIR__ . '/../Views/admin/product_table.php';
    } else {
        include __DIR__ . '/../Views/client/sidebarComponent.php';

    }
}



    public function createForm()
    {
        $categories = $this->categoryModel->getAll();
        include __DIR__ . '/../Views/admin/addproduct.php';
    }

    // Xử lý POST
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=product&action=createForm');
            exit;
        }

        $product_name = trim($_POST['product_name']);
        $category_id  = (int) ($_POST['category_id'] ?? 0);
        $discount     = (int) ($_POST['discount'] ?? 0);
        $price        = (int) ($_POST['price'] ?? 0);

        // ==== UPLOAD ẢNH ====
        $imageName = null;
        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . '_' . $_FILES['image']['name'];//gán time hiện để tránh trùng tên ảnh
            
            $target = __DIR__ . '../../Assets/img/' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }

        $this->productModel->create([
            'product_name' => $product_name,
            'category_id'  => $category_id,
            'discount'     => $discount,
            'price'        => $price,
            'image'        => $imageName
        ]);

        header('Location: index.php?controller=product&action=index');
        exit;
    }
    public function delete()
    {
        $product_id = (int) ($_GET['product_id'] ?? 0);

        if ($product_id > 0) {
            $this->productModel->delete($product_id);
        }

        header('Location: index.php?controller=product&action=index');
        exit;
    }

    // Hiển thị form sửa
public function editForm()
{
    $product_id = (int)($_GET['product_id'] ?? 0);

    if ($product_id <= 0) {
        header('Location: index.php?controller=product&action=index');
        exit;
    }

    $product = $this->productModel->getById($product_id);
    $categories = $this->categoryModel->getAll();

    if (!$product) {
        header('Location: index.php?controller=product&action=index');
        exit;
    }

    include __DIR__ . '/../Views/admin/editproduct.php';
}

// Xử lý cập nhật
public function update()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?controller=product&action=index');
        exit;
    }

    $product_id   = (int)$_POST['product_id'];
    $product_name = trim($_POST['product_name']);
    $category_id  = (int)$_POST['category_id'];
    $discount     = (int)$_POST['discount'];
    $price        = (int)$_POST['price'];
    $old_image    = $_POST['old_image'] ?? null;

    // ==== UPLOAD ẢNH MỚI (NẾU CÓ) ====
    $imageName = $old_image;
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . $_FILES['image']['name'];
        $target = __DIR__ . '../../Assets/img/' . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $this->productModel->update($product_id, [
        'product_name' => $product_name,
        'category_id'  => $category_id,
        'discount'     => $discount,
        'price'        => $price,
        'image'        => $imageName
    ]);

    header('Location: index.php?controller=product&action=index');
    exit;
}



}
