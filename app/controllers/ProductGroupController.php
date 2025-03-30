<?php
require_once __DIR__ . '/../models/ProductGroup.php';
require_once 'Controller.php';
require_once __DIR__ . '/../validations/ProductGroupValidations.php';
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
        // Validar que el producto y el grupo existen
        
      
        if ($this->productGroupModel->validateExistence($data['producto_id'], $data['grupo_id'])) {
            $this->response(['status' => 'error', 'message' => 'Este producto ya está asignado a este grupo']);

        } elseif ($this->productGroupModel->assignProductToGroup($data['producto_id'], $data['grupo_id'])) {
            $this->response(['status' => 'success', 'message' => 'Producto asignado al grupo']);

        } else {

            $this->response(['status' => 'error', 'message' => 'Error al asignar producto'], 500);
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


    public function GroupValidations($data)
    {
        $productGroupValidations = new ProductGroupValidations();
        $productIdValidation = $productGroupValidations->validateProductId($data['producto_id']);
        if ($productIdValidation !== true) {
            return $this->response(['error' => $productIdValidation], 400);
        }
        $groupIdValidation = $productGroupValidations->validateGroupId($data['grupo_id']);
        if ($groupIdValidation !== true) {
            return $this->response(['error' => $groupIdValidation], 400);
        }
        $productExistsValidation = $productGroupValidations->productExists($data['producto_id']);
        if ($productExistsValidation !== true) {
            return $this->response(['error' => $productExistsValidation], 400);
        }
        $groupExistsValidation = $productGroupValidations->groupExists($data['grupo_id']);
        if ($groupExistsValidation !== true) {
            return $this->response(['error' => $groupExistsValidation], 400);
        }
    }
}
