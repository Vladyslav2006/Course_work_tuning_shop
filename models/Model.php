<?php

class Model
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "tuning_shop");

        if ($this->db->connect_error) {
            die("DB connection failed: " . $this->db->connect_error);
        }

        $this->db->set_charset("utf8");
    }

    public function register($login, $password)
    {
        $login = $this->db->real_escape_string($login);
        $password = password_hash($password, PASSWORD_DEFAULT);

        return $this->db->query("
            INSERT INTO users (login, password)
            VALUES ('$login', '$password')
        ");
    }

    public function getUser($login, $password)
    {
        $login = $this->db->real_escape_string($login);

        $result = $this->db->query("
            SELECT * FROM users WHERE login = '$login'
        ");

        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function userExists($login)
    {
        $login = $this->db->real_escape_string($login);

        $result = $this->db->query("
            SELECT id FROM users WHERE login='$login'
        ");

        return $result->num_rows > 0;
    }

    public function getCategories()
    {
        return $this->db->query("
            SELECT * FROM categories
            ORDER BY name ASC
        ");
    }

    public function getCategoryById($id)
    {
        $id = (int)$id;

        $result = $this->db->query("
            SELECT * FROM categories WHERE id=$id
        ");

        return $result->fetch_assoc();
    }

    public function addCategory($name, $image)
    {
        $name = $this->db->real_escape_string($name);
        $image = $this->db->real_escape_string($image);

        return $this->db->query("
            INSERT INTO categories (name, image)
            VALUES ('$name', '$image')
        ");
    }

    public function updateCategory($id, $name, $image = null)
    {
        $id = (int)$id;
        $name = $this->db->real_escape_string($name);

        $sql = "UPDATE categories SET name='$name'";

        if ($image) {
            $image = $this->db->real_escape_string($image);
            $sql .= ", image='$image'";
        }

        $sql .= " WHERE id=$id";

        return $this->db->query($sql);
    }

    public function deleteCategory($id)
    {
        $id = (int)$id;

        return $this->db->query("
            DELETE FROM categories WHERE id=$id
        ");
    }

    public function categoryHasProducts($categoryId)
    {
        $categoryId = (int)$categoryId;

        $result = $this->db->query("
            SELECT id FROM products WHERE category_id = $categoryId LIMIT 1
        ");

        return $result->num_rows > 0;
    }

    public function getProductsByCategoryId($categoryId, $search = '')
    {
        $categoryId = (int)$categoryId;
        $search = $this->db->real_escape_string($search);

        $sql = "
            SELECT * FROM products 
            WHERE category_id = $categoryId
        ";

        if (!empty($search)) {
            $sql .= " AND name LIKE '%$search%'";
        }

        $sql .= " ORDER BY name ASC";

        return $this->db->query($sql);
    }

    public function getProduct($id)
    {
        $id = (int)$id;

        $result = $this->db->query("
            SELECT * FROM products WHERE id=$id
        ");

        return $result->fetch_assoc();
    }

    public function addProduct($name, $description, $price, $country, $image, $categoryId)
    {
        $name = $this->db->real_escape_string($name);
        $description = $this->db->real_escape_string($description);
        $price = (float)$price;
        $country = $this->db->real_escape_string($country);
        $image = $this->db->real_escape_string($image);
        $categoryId = (int)$categoryId;

        return $this->db->query("
            INSERT INTO products 
            (name, description, price, country, image, category_id)
            VALUES 
            ('$name', '$description', $price, '$country', '$image', $categoryId)
        ");
    }

    public function updateProduct($id, $name, $description, $price, $country, $category_id, $imagePath = null)
    {
        $id = (int)$id;
        $name = $this->db->real_escape_string($name);
        $description = $this->db->real_escape_string($description);
        $price = (float)$price;
        $country = $this->db->real_escape_string($country);
        $category_id = (int)$category_id;

        $sql = "
            UPDATE products 
            SET 
                name='$name',
                description='$description',
                price=$price,
                country='$country',
                category_id=$category_id
        ";

        if ($imagePath) {
            $imagePath = $this->db->real_escape_string($imagePath);
            $sql .= ", image='$imagePath'";
        }

        $sql .= " WHERE id=$id";

        return $this->db->query($sql);
    }

    public function deleteProduct($id)
    {
        $id = (int)$id;

        return $this->db->query("
            DELETE FROM products WHERE id=$id
        ");
    }
}