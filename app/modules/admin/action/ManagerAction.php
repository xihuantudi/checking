<?php
namespace app\admin\action;

use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\admin\service\AdminService;
use app\admin\service\AdminRoleService;
use herosphp\string\StringUtils;

/**
 * 管理员控制器
 * @author  yangjian<yangjian102621@gmail.com>
 */
class ManagerAction extends CommonAction {

    protected $serviceClass = AdminService::class;

    protected $actionTitle = "管理员";

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {

        parent::index($request);
        $this->setOpt($this->actionTitle.'列表');
        $this->setView("admin/admin_index");

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'添加');
        $this->setView('admin/admin_add');

        $this->loadRoles();
    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {

        $this->setOpt($this->actionTitle.'修改');
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        $roleIds = StringUtils::jsonDecode($item['role_ids']);
        $this->assign('roleIds', $roleIds);
        $this->setView('admin/admin_edit');

        $this->loadRoles();
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data');
        $rids = $request->getParameter('rids');
        $data['role_ids'] = StringUtils::jsonEncode($rids);
        //生成密码盐
        $data['salt'] = StringUtils::genGlobalUid();
        $data['password'] = genPassword($data['password'], $data['salt']);
        parent::_insert($data);
    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data');
        $id = $request->getParameter('id', 'intval');
        $password = $request->getParameter('password', 'trim');
        $rids = $request->getParameter('rids');
        $data['role_ids'] = StringUtils::jsonEncode($rids);
        if (!empty($password)) {
            $data['password'] = genPassword($password, $data['salt']);
        }
        parent::_update($data, $id);
    }

    /**
     * 加载角色
     */
    protected function loadRoles() {
        $service = Loader::service(AdminRoleService::class);
        $roles = $service->find();
        $this->assign('roles', $roles);
    }
}