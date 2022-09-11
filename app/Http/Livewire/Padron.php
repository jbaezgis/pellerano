<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Persona;

class Padron extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalActivar = false;
    public $modalInactivar = false;
    public $modelId;
    public $nombre, $telefono;
    public $search;
    // public $personas;

    public function mount()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'nombre' => 'required',
            'telefono' => 'required',
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
        $data = Persona::find($this->modelId);
        $this->modalFormVisible = true;
        $this->nombre = $data->nombre;
        $this->telefono = $data->telefono;
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDelete = true;
    }

    public function modelData()
    {
        return [
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
        ];
    }

    public function create()
    {
        $this->validate();
        Persona::create($this->modelData());
        $this->dispatchBrowserEvent('event-notification', [
            'eventName' => 'Nuevo Persona :D',
            'eventMessage' => 'Persona creado exitosamente!'
        ]);
        $this->reset();
    }

    public function read()
    {
        return Persona::paginate(5);
    }

    public function update()
    {
        $this->validate();
        Persona::where('id', $this->modelId)
            ->update($this->modelData());
        $this->dispatchBrowserEvent('event-notification', [
            'eventName' => 'Persona actualizado :D',
            'eventMessage' => 'El Persona "' . $this->nombre . '" fue actualizado!'
        ]);
        $this->reset();
    }

    public function delete()
    {
        Persona::destroy($this->modelId);
        $this->dispatchBrowserEvent('event-notification', [
            'eventName' => 'Persona eliminado :,(',
            'eventMessage' => 'El Persona "' . $this->modelId . '" fue eliminado!'
        ]);
        $this->reset();
    }

    
    public function activo($id)
    {
        Persona::where('id', $id)
            ->update(['estado' => 1]);

        $this->reset();
    }

    public function inactivarShowModal($id)
    {
        $this->modelId = $id;
        $this->modalInactivar = true;
    }

    public function inactivo()
    {
        Persona::where('id', $this->modelId)
            ->update(['estado' => 0]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.padron', [
            'personas' => Persona::where('nombre', 'LIKE', "%{$this->search}%")->orWhere('telefono', 'LIKE', "%{$this->search}%")->latest()->paginate(20),
        ]);
    }
}
