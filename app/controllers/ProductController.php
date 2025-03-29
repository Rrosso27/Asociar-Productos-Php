<?php
require_once __DIR__ . '/../models/Product.php';
require_once 'Controller.php';

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    // Obtener todos los productos
    public function index() {
        $products = $this->productModel->getAll();
        $this->response($products);
    }

    // Obtener un producto por ID
    public function getProducts($id) {
        $product = $this->productModel->getById($id);
        if ($product) {
            $this->response($product);
        } else {
            $this->response(['error' => 'Producto no encontrado'], 404);
        }
    }

    // Crear un nuevo producto
    public function addProduct($data) {
     
        // Crear instancia del modelo
        $product = new Product();
        // Guardar en la base de datos
        $result = $product->create($data);

        if ($result) {
            return ['status' => 'success', 'message' => 'Producto agregado correctamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al guardar el producto'];
        }
    }

    // Actualizar un producto
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->productModel->update($id, $data)) {
            $this->response(['message' => 'Producto actualizado correctamente']);
        } else {
            $this->response(['error' => 'Error al actualizar producto'], 500);
        }
    }

    // Eliminar un producto
    public function destroy($id) {
        if ($this->productModel->delete($id)) {
            $this->response(['message' => 'Producto eliminado']);
        } else {
            $this->response(['error' => 'Error al eliminar producto'], 500);
        }
    }
}
