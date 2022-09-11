<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalResetPassword = false;
    public $modelId;
    public $name, $email, $role, $password;
    public $search;
    public $formMode;

    public function mount()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ];
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->modelId = $id;
        $data = User::find($this->modelId);
        $this->modalFormVisible = true;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDelete = true;
    }

    public function createModelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => bcrypt('12345678'),
        ];
    }

    public function updateModelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }

    public function create()
    {
        $this->validate();
        User::create($this->createModelData());
        $this->notification()->success(
            $title = __('User added!'),
            $description = __('User added correcly.')
        );
        $this->reset();
    }

    public function read()
    {
        return User::paginate(5);
    }

    public function update()
    {
        $this->formMode = 'update';
        $this->validate();
        User::where('id', $this->modelId)
            ->update($this->updateModelData());
        $this->notification()->success(
            $title = __('User updated!'),
            $description = __('User updated correcly.')
        );
        $this->reset();
    }

    public function delete()
    {
        User::destroy($this->modelId);
        $this->notification()->success(
            $title = __('User deleted!'),
            $description = __('User deleted correcly.')
        );
        $this->reset();
    }

    public function confirmResetPasswordModal($id)
    {
        $this->modelId = $id;
        $this->modalResetPassword = true;
    }

    public function resetPassword()
    {
        User::where('id', $this->modelId)
            ->update(['password' => bcrypt('12345678')]);
        $this->notification()->success(
            $title = __('Password reset!'),
            $description = __('User reset correcly.')
        );
        $this->reset();
    }

    public function render()
    {
        return view('livewire.usuarios', [
            'users' => User::where('name', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%")->latest()->paginate(10),
        ]);
    }
}
