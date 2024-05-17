<?php


class ProductController
{

    public function index()
    {
        $db = new Product();
        $data['products'] = $db->getAllproducts();
        View::load('product/index', $data);
    }
    public function add()
    {

        View::load('product/add');
    }
    public function store()
    {

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $qty = $_POST['qty'];
            $data =  array(

                'name' => $name,
                'price' => $price,
                'description' => $description,
                'qty' => $qty
            );
            $db = new Product();
            if ($db->insertProduct($data)) {
                View::load('product/add', ['success' => 'data inserted succssfuly']);
            }
        } else {
            View::load('product/add');
        }
    }

    public function edit($id)
    {
        $db = new Product();
        if ($db->getRow($id)) {
            $data['row'] = $db->getRow($id);
            View::load('product/edit', $data);
        } else {
            echo 'error';
        }
    }
    public function delete($id)
    {
        $db = new Product();
        if ($db->deleteProduct($id)) {
            View::load('product/delete');
        } else {
            echo 'error';
        }
    }
    public function update($id)
    {

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $qty = $_POST['qty'];
            $datainsert =  array(

                'name' => $name,
                'price' => $price,
                'description' => $description,
                'qty' => $qty
            );
            $db = new Product();
            if ($db->updateProduct($id , $datainsert)) {
                View::load('product/edit', ['success' => 'data Updated succssfuly','row'=>$db->getRow($id)]);
            }
        } else {
            View::load('product/edit');
        }
    }
}
