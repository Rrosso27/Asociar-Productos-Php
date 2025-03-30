<?php
require_once __DIR__ . '/../models/Group.php';
require_once 'Controller.php';
require_once __DIR__ . '/../validations/GroupValidations.php';
class GroupController extends Controller
{
    private $groupModel;

    public function __construct()
    {
        $this->groupModel = new Group();
    }

    public function index()
    {
        $groups = $this->groupModel->getAll();
        $this->response($groups);
    }

    public function show($id)
    {
        $group = $this->groupModel->getById($id);
        if ($group) {
            $this->response($group);
        } else {
            $this->response(['error' => 'Grupo no encontrado'], 404);
        }
    }

    public function addGroup($data)
    {

        $validation = $this->validateGroup($data);
        if ($validation !== true) {
            return $validation;
        }
        $result = $this->groupModel->create(data: $data);
        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Grupo agregado correctamente']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Error al guardar el Grupo']);
        }
    }

    public function update($id, $data)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->groupModel->update($id, $data)) {
            $this->response(['message' => 'Grupo actualizado correctamente']);
        } else {
            $this->response(['error' => 'Error al actualizar grupo'], 500);
        }
    }

    public function destroy($id)
    {
        if ($this->groupModel->delete($id)) {
            $this->response(['message' => 'Grupo eliminado']);
        } else {
            $this->response(['error' => 'Error al eliminar grupo'], 500);
        }
    }

    public function validateGroup($data)
    {
        $validations = new GroupValidations();
        $nameValidation = $validations->validateGroupName($data['nombre']);
        if ($nameValidation !== true) {
            return json_encode(['status' => 'error', 'message' => $nameValidation]);

        }
        $descriptionValidation = $validations->validateGroupDescription($data['descripcion']);
        if ($descriptionValidation !== true) {
            return json_encode(['status' => 'error', 'message' => $descriptionValidation]);

        }
        return true;
    }
}
