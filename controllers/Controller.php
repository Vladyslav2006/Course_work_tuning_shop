<?php
require "models/Model.php";

class Controller {

    private $model;

    public function __construct() {
        session_start();
        $this->model = new Model();
    }

    private function checkAuth(){
        if(!isset($_SESSION['user'])){
            header("Location:index.php?action=login");
            exit;
        }
    }

    private function checkAdmin(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']['isAdmin'])){
            header("Location:index.php");
            exit;
        }
    }

    public function route() {

        $action = $_GET['action'] ?? 'main';

        switch($action){

            case 'login': 
                $this->login(); 
                break;

            case 'logout': 
                session_destroy(); 
                header("Location:index.php"); 
                break;

            case 'register': 
                $this->register(); 
                break;

            case 'forgot': 
                $this->forgot(); 
                break;

            case 'catalog':
                $this->catalog();
                break;

            case 'category':
                $this->category();
                break;

            case 'details':
                $this->details();
                break;

            case 'add':
                $this->checkAuth();
                $this->checkAdmin();
                $this->add();
                break;

            case 'delete':
                $this->checkAuth();
                $this->checkAdmin();
                $this->delete();
                break;

            case 'edit':
                $this->checkAuth();
                $this->checkAdmin();

                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $this->updateProduct();
                } else {
                    $this->editForm();
                }
                break;

            case 'delete_category':
                $this->checkAuth();
                $this->checkAdmin();
                $this->deleteCategory();
                break;

            case 'add_to_cart':
                $this->checkAuth();
                $this->addToCart();
                break;

            case 'cart':
                $this->checkAuth();
                $this->cart();
                break;

            case 'remove_from_cart':
                $this->checkAuth();
                $this->removeFromCart();
                break;

            case 'info': 
                $this->info(); 
                break;

            case 'support': 
                $this->support(); 
                break;

            case 'main':
                $this->main();
                break;

            case 'add_category':
                $this->checkAuth();
                $this->checkAdmin();
                $this->addCategory();
                break;

            case 'edit_category':
                $this->checkAuth();
                $this->checkAdmin();

                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $this->updateCategory();
                } else {
                    $this->editCategoryForm();
                }
                break;

            default:
                $this->notFound();
        }
    }

    private function login(){
        if($_POST){
            $user = $this->model->getUser($_POST['login'], $_POST['password']);

            if($user){
                $_SESSION['user'] = [
                    'login' => $user['login'],
                    'isAdmin' => (int)$user['isAdmin']
                ];

                header("Location:index.php");
                exit;
            } else {
                $error = "Wrong login or password";
            }
        }

        require "templates/login.php";
    }

    private function register(){
        if($_POST){
            if(!$this->model->register($_POST['login'], $_POST['password'])){
                $error = "User already exists";
            } else {
                header("Location:index.php?action=login");
                exit;
            }
        }

        require "templates/register.php";
    }

    private function forgot(){
        if($_POST){
            if(!$this->model->userExists($_POST['login'])){
                $error = "User not found";
            } else {
                $success = "Password reset instruction sent (demo)";
            }
        }

        require "templates/forgot.php";
    }

    private function main(){
        require "templates/main.php";
    }

    private function catalog(){
        $categories = $this->model->getCategories();
        require "templates/catalog.php";
    }

    private function category(){

        $category_id = $_GET['id'] ?? null;
        $search = $_GET['search'] ?? '';

        $category = $this->model->getCategoryById($category_id);
        $products = $this->model->getProductsByCategoryId($category_id, $search);

        require "templates/category.php";
    }

    private function details(){
        $product = $this->model->getProduct($_GET['id']);
        require "templates/details.php";
    }

    private function add(){

        $category_id = $_GET['cat'] ?? null;

        if($_POST){

            $img = null;

            if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){

                $uploadDir = __DIR__ . '/../car_images/';

                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }

                $filename = time().'_'.basename($_FILES['image']['name']);
                $target = $uploadDir.$filename;

                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                    $img = 'car_images/'.$filename;
                }
            }

            $this->model->addProduct(
                $_POST['name'],
                $_POST['description'],
                $_POST['price'],
                $_POST['country'],
                $img,
                $category_id
            );

            header("Location:index.php?action=category&id=".$category_id);
            exit;
        }

        require "templates/form.php";
    }

    private function editForm(){

        $id = (int)($_GET['id'] ?? 0);

        if(!$id){
            header("Location:index.php?action=catalog");
            exit;
        }

        $product = $this->model->getProduct($id);
        require "templates/edit.php";
    }

    private function updateProduct(){

        $id = (int)$_POST['id'];

        $imagePath = null;

        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

            $uploadDir = __DIR__ . '/../car_images/';

            if(!is_dir($uploadDir)){
                mkdir($uploadDir, 0777, true);
            }

            $filename = time().'_'.basename($_FILES['image']['name']);
            $target = $uploadDir.$filename;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                $imagePath = 'car_images/'.$filename;
            }
        }

        $this->model->updateProduct(
            $id,
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $_POST['country'],
            $_POST['category_id'],
            $imagePath
        );

        header("Location:index.php?action=details&id=".$id);
        exit;
    }

    private function delete(){
        $id = (int)($_GET['id'] ?? 0);

        $this->model->deleteProduct($id);

        header("Location:".$_SERVER['HTTP_REFERER']);
        exit;
    }

    private function addCategory(){

        if($_POST){

            $img = null;

            if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){

                $uploadDir = __DIR__ . '/../car_images/';

                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }

                $filename = time().'_'.basename($_FILES['image']['name']);
                $target = $uploadDir.$filename;

                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                    $img = 'car_images/'.$filename;
                }
            }

            $this->model->addCategory(
                $_POST['name'],
                $img
            );

            header("Location:index.php?action=catalog");
            exit;
        }

        require "templates/add_category.php";
    }

    private function editCategoryForm(){

        $id = (int)($_GET['id'] ?? 0);

        if(!$id){
            header("Location:index.php?action=catalog");
            exit;
        }

        $category = $this->model->getCategoryById($id);

        require "templates/edit_category.php";
    }

    private function updateCategory(){

        $id = (int)$_POST['id'];

        $imagePath = null;

        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

            $uploadDir = __DIR__ . '/../car_images/';

            if(!is_dir($uploadDir)){
                mkdir($uploadDir, 0777, true);
            }

            $filename = time().'_'.basename($_FILES['image']['name']);
            $target = $uploadDir.$filename;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                $imagePath = 'car_images/'.$filename;
            }
        }

        $this->model->updateCategory(
            $id,
            $_POST['name'],
            $imagePath
        );

        header("Location:index.php?action=catalog");
        exit;
    }

    private function deleteCategory(){

        $id = (int)($_GET['id'] ?? 0);

        if($this->model->categoryHasProducts($id)){
            die("Category contains products");
        }

        $this->model->deleteCategory($id);

        header("Location:index.php?action=catalog");
        exit;
    }

    private function addToCart(){

        $id = (int)$_GET['id'];

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        header("Location:index.php?action=cart");
        exit;
    }

    private function cart(){

        $cart = $_SESSION['cart'] ?? [];
        $products = [];

        foreach($cart as $id => $qty){
            $p = $this->model->getProduct($id);
            if($p){
                $p['qty'] = $qty;
                $products[] = $p;
            }
        }

        require "templates/cart.php";
    }

    private function removeFromCart(){

        $id = (int)$_GET['id'];

        unset($_SESSION['cart'][$id]);

        header("Location:index.php?action=cart");
        exit;
    }

    private function info(){
        require "templates/info.php";
    }

    private function support(){
        require "templates/support.php";
    }

    private function notFound(){
        http_response_code(404);
        require "templates/not_found.php";
    }
}