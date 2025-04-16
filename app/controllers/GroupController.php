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
    /**
     * Obtener todos los grupos
     * @return void
     */
    public function index()
    {
        $groups = $this->groupModel->getAll();
        $this->response($groups);
    }
    /**
     * Obtener un grupo por ID
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $group = $this->groupModel->getById($id);
        if ($group) {
            $this->response($group);
        } else {
            $this->response(['error' => 'Grupo no encontrado'], 404);
        }
    }
    
    /**
     * Agregar un nuevo grupo
     * @param array $data
     * @return array
     */

    public function addGroup($data)
    {
        $validation = $this->validateGroup($data);
        if ($validation !== true) {
            return ['status' => 'error', 'message' => $validation];
        }
        $result = $this->groupModel->create($data);
        if ($result) {
            return ['status' => 'success', 'message' => 'Grupo agregado correctamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al guardar el Grupo'];
        }
    }
    
    /**
     * Actualizar un grupo existente
     * @param array $data
     * @return void
     */

    public function update($data)
    {
        $validation = $this->validateGroup($data);
        if ($validation !== true) {
            return $validation;
        }
        if ($this->groupModel->update($data)) {
            $this->response(['status' => 'success', 'message' => 'Grupo actualizado correctamente'], 200);
        } else {
            $this->response(['status' => 'error', 'message' => 'Error al actualizar grupo'], 500);
        }
    }
    /**
     * Eliminar un grupo por ID
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        if ($this->groupModel->delete($id)) {
            $this->response(['message' => 'Grupo eliminado']);
        } else {
            $this->response(['error' => 'Error al eliminar grupo'], 500);
        }
    }
    
    /**
     * Validar los datos del grupo
     * @param array $data
     * @return mixed
     */

    public function validateGroup($data)
    {
        $validations = new GroupValidations();
        $nameValidation = $validations->validateGroupName($data['nombre']);
        if ($nameValidation !== true) {
            return json_encode($nameValidation);

        }
        $descriptionValidation = $validations->validateGroupDescription($data['descripcion']);
        if ($descriptionValidation !== true) {
            return json_encode($descriptionValidation);

        }
        $groupExistsByName = $validations->groupExistsByName($data['nombre']);
        if ($groupExistsByName !== true) {
            return json_encode($groupExistsByName);
        }
        return true;
    }
}
