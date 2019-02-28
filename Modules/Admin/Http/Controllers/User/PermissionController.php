<?php

namespace Modules\Admin\Http\Controllers\User;

use App\Model\Code;
use App\Model\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AdminController;

class PermissionController extends AdminController
{

    protected static $rules = [
        'default'      => [
            'name'   => 'nullable|string|min:1',
            'title'  => 'nullable|string|min:1',
            'module' => 'nullable|string|min:1',
        ],
        'getShow'      => [
            'id' => 'required|integer|min:1|exists:permissions,id',
        ],
        'postUpdate'   => [
            'name'   => 'required|string|min:1',
            'title'  => 'required|string|min:1',
            'id'     => 'nullable|integer|min:1',
            'module' => 'nullable|string|min:1',
        ],
        'deleteDelete' => [
            'id' => 'required|integer|min:1|exists:permissions,id',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request): Response
    {
        $data = $request->all();
        $this->checkValidate($data, 'getIndex');
        $permission = new Permission();
        if ($request->input('with_trashed')) {
            $permission = $permission->withTrashed();
        }
        $pagination = $this->getPaginateResponse($permission->paginate($this->pageSize));
        return $this->response($pagination);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function postUpdate(Request $request): Response
    {
        $data = $request->only('title', 'module', 'name', 'id');
        $this->checkValidate($data, 'postUpdate');
        $id                = $request->input('id') ?: 0;
        $permission        = $id > 0 ? Permission::withTrashed()->findOrFail(+$id) : new Permission();
        $permission->name  = $data['name'];
        $permission->title = @$data['title'] ?: '';
        @$data['module'] !== null && $permission->module = $data['module'];
        $permission->saveOrFail();
        return $this->response($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getShow(Request $request): Response
    {
        $this->checkValidate($request->all(), 'getShow');
        $id         = +$request->input('id');
        $permission = Permission::findOrFail($id);
        return $this->response($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function deleteDelete(Request $request): Response
    {
        $this->checkValidate($request->all(), 'deleteDelete');
        $id         = +$request->input('id');
        $permission = Permission::findOrFail($id);
        $ret        = $permission->delete();
        if (!$ret) {
            Code::setCode(Code::ERR_DB_FAIL);
        }
        return $this->response();
    }
}
