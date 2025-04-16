<?php
require_once __DIR__ . '/../validations/ProductValidations.php';
require_once __DIR__ . '/../validations/GroupValidations.php';
require_once __DIR__ . '/../models/Product.php';
require_once 'Controller.php';

class ProductController extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }
    /**
     * Obtener todos los productos
     * @return void
     */
    public function index()
    {
        $products = $this->productModel->getAll();
        $this->response($products);
    }
    /**
     * Obtener un producto por ID
     * @param int $id
     * @return void
     */
    public function getProducts($id)
    {
        $product = $this->productModel->getById($id);
        if ($product) {
            $this->response($product);
        } else {
            $this->response(['error' => MessageHandler::get('Product_no_found')], 404);
        }
    }
    /**
     * Obtener productos por grupo
     * @param int $id
     * @return string
     */
    public function addProduct($data)
    {

        $validateProduc = $this->validateProduc($data);
        if ($validateProduc !== true) {
            return $validateProduc;
        }

        $product = new Product();
        $result = $product->create(data: $data);

        if ($result) {
            return json_encode(['status' => 'success', 'message' => MessageHandler::get('Product_add_success')], 201);
        } else {
            return json_encode(['status' => 'error', 'message' => MessageHandler::get('Product_add_error')]);
        }
    }

    /**
     * Actualizar un producto (update)
     * @param int $id
     * @return string
     */
    public function update($data)
    {

        $validateProduc = $this->validateProduc($data);
        if ($validateProduc !== true) {
            return $validateProduc;
        }

        if ($this->productModel->update($data)) {
            $this->response(['status' => 'success', 'message' => MessageHandler::get('Product_upd_success')], 201);
        } else {
            $this->response(['status' => 'error', 'message' => MessageHandler::get('Product_add_error')], 500);
        }
    }
    /**
     * Eliminar un producto (delete)
     * @param int $id
     * @return string
     */
    public function destroy($id)
    {
        if ($this->productModel->delete($id)) {
            $this->response(['message' => MessageHandler::get('Product_delete_success')], 204);
        } else {
            $this->response(['error' => MessageHandler::get('Product_delete_error')], 500);
        }
    }
    /**
     * Validar datos del producto
     * @param array $data
     * @return bool|string
     */
    public function validateProduc($data)
    {
        $ProductValidations = new ProductValidations();

        $validateProductName = $ProductValidations->validateProductName($data['nombre']);
        if ($validateProductName !== true) {
            return json_encode(['status' => 'error', 'message' => $validateProductName]);
        }
        $validateProductPrice = $ProductValidations->validateProductPrice($data['precio']);
        if ($validateProductPrice !== true) {
            return json_encode(['status' => 'error', 'message' => $validateProductPrice]);
        }
        $validateProductDescription = $ProductValidations->validateProductDescription($data['descripcion']);
        if ($validateProductDescription !== true) {
            return json_encode(['status' => 'error', 'message' => $validateProductDescription]);
        }
        $validateProductStock = $ProductValidations->validateProductCStock($data['stock']);
        if ($validateProductStock !== true) {
            return json_encode(['status' => 'error', 'message' => $validateProductStock]);
        }
        $productsExistName = $this->productModel->productsExistName($data['nombre']);
        if ($productsExistName) {
            return json_encode(['status' => 'error', 'message' => 'El producto ya existe.']);
        }
        return true;
    }
}
