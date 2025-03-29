<?php
require_once __DIR__ . '/../models/Group.php';
require_once 'Controller.php';

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
}
