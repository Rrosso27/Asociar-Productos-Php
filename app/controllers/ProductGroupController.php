<?php
require_once __DIR__ . '/../models/ProductGroup.php';
require_once 'Controller.php';

class ProductGroupController extends Controller
{
    private $productGroupModel;

    public function __construct()
    {
        $this->productGroupModel = new ProductGroup();
    }
    public function index()
    {
        $products = $this->productGroupModel->getAll();
        $this->response($products);
    }

    public function getGroupsByProduct($id)
    {
        $products = $this->productGroupModel->getGroupsByProduct($id);
        $this->response($products);
    }


    public function assign($data)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->productGroupModel->assignProductToGroup($data['producto_id'], $data['grupo_id'])) {
            $this->response(['message' => 'Producto asignado al grupo']);
        } else {
            $this->response(['error' => 'Error al asignar producto'], 500);
        }
    }

    public function remove($data)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->productGroupModel->removeProductFromGroup($data['producto_id'], $data['grupo_id'])) {
            $this->response(['message' => 'Producto eliminado del grupo']);
        } else {
            $this->response(['error' => 'Error al eliminar producto del grupo'], 500);
        }
    }

   
}
