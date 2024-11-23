<?php

namespace App\Services\System\User;

use App\Events\SetPasswordEvent;
use App\Exceptions\CustomExceptionHandler;
use App\Models\User;
use App\Services\Service;
use App\Models\Role;
use App\Models\UserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    protected $role, $userPassword;

    public function __construct(User $model, Role $role, UserPassword $userPassword)
    {
        parent::__construct($model);
        $this->role = $role;
        $this->userPassword = $userPassword;
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->role_id)) {
            $query->where('role_id',  $request->role_id);
        }

        if (isset($request->keyword)) {
            $query->where('name', 'LIKE',  '%' . $request->keyword . '%');
        }

        // $query->where('username', '!=', 'admin');
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function indexPageData(Request $request)
    {
        return  [
            'items' => $this->getAllData($request),
            'roles' => Role::pluck('name', 'id'),
        ];
    }

    public function createPageData($request)
    {
        return [
            'status' => $this->status(),
            'roles' => $this->role->pluck('name', 'id'),
            'setupMethods' => [
                [
                    'value' => 'set_password',
                    'label' => 'Set Password',
                ],
                [
                    'value' => 'via_email',
                    'label' => 'Send Via Email',
                ],
            ]
        ];
    }

    public function editPageData($id)
    {
        return [
            'item' => $this->getItemById($id),
            'status' => $this->status(),
            'roles' => $this->role->pluck('name', 'id')
        ];
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            try {
                $data = $request->except('_token');
                $data['username'] = usernameConverter($request->name);
                if ($request->setup_method === 'set_password') {
                    $data['password'] = Hash::make($request->password);
                    $data['is_password_set'] = true;
                    $model = $this->model->create($data);
                    $this->userPassword->create([
                        'user_id' => $model->id,
                        'password' => $model->password,
                    ]);
                } else {
                    $data['token'] = generateToken(10);
                    $password = generatePassword(6);
                    $data['password'] = Hash::make($password);
                    $user = $this->model->create($data);
                    $this->sendPasswordLink($user, $password);
                }
            } catch (\Exception $e) {
                $request->flash();
                throw new CustomExceptionHandler($e->getMessage());
            }
        });
    }

    public function resendPassword($userId)
    {
        $user = $this->model->where('id', $userId)->first();
        $password = generatePassword(6);

        if ($user) {
            $user->update([
                'password' => Hash::make($password)
            ]);
            $this->sendPasswordLink($user, $password);
        }
    }

    public function sendPasswordLink($user, $password)
    {
        event(new SetPasswordEvent($user, $password));
    }

    public function delete($request, $id)
    {
        $user = User::find($id);

        if ($user->role->slug == 'super_admin') {
            throw new CustomExceptionHandler('hello world');
        }


        $data = $this->getItemById($id);
        $data->delete();
    }
}
