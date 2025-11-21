<?php
require_once __DIR__ . '/../models/DanhMucModel.php';

class DanhMucController {
    private $model;

    public function __construct() {
        $this->model = new DanhMucModel();
    }

    public function index() {
        $list = $this->model->getAll();
        require_once __DIR__ . '/../views/admin/danhMuc/list.php';
    }

    public function addForm() {
        require_once __DIR__ . '/../views/admin/danhMuc/add.php';
    }

    public function addSubmit() {
        $ten = trim($_POST['ten_danh_muc'] ?? '');
        $mo_ta = trim($_POST['mo-ta'] ?? '');
        $errors = [];

        if ($ten === '') $errors[] = 'Tên danh mục không được để trống';

        if (!empty($errors)) {
            $old = ['ten_danh_muc'=>$ten, 'mo-ta'=>$mo_ta];
            require_once __DIR__ . '/../views/admin/danhMuc/add.php';
            return;
        }

        $this->model->add($ten, $mo_ta);
        header("Location: index.php?act=danhMuc&action=index");
        exit;
    }

    public function editForm() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            header("Location: index.php?act=danhMuc&action=index");
            exit;
        }
        require_once __DIR__ . '/../views/admin/danhMuc/edit.php';
    }

    public function editSubmit() {
        $id = $_POST['id'] ?? 0;
        $ten = trim($_POST['ten_danh_muc'] ?? '');
        $mo_ta = trim($_POST['mo-ta'] ?? '');
        $errors = [];

        if ($id <= 0) $errors[] = 'ID không hợp lệ';
        if ($ten === '') $errors[] = 'Tên danh mục không được để trống';

        if (!empty($errors)) {
            $old = ['id'=>$id,'ten_danh_muc'=>$ten,'mo-ta'=>$mo_ta];
            require_once __DIR__ . '/../views/admin/danhMuc/edit.php';
            return;
        }

        $this->model->update($id, $ten, $mo_ta);
        header("Location: index.php?act=danhMuc&action=index");
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) $this->model->delete($id);
        header("Location: index.php?act=danhMuc&action=index");
        exit;
    }
}
