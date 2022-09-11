@section('title', __('Users'))
<div>
    <div class="max-w-7xl mx-auto pt-6 px-2">
        <h1 class="text-3xl font-bold text-gray-600 mb-4">Users</h1>

       

        <div class="flex justify-between p-2 bg-white rounded-t shadow">
            <div>
                <x-jet-input id="search" class="block mt-1 w-full" type="text" name="search" wire:model.debounce.500ms="search" placeholder="Nombre o Correo"/>
            </div>
            <div>
                <div class="flex gap-2">
                 
                    <div>
                        <x-jet-button wire:click="createShowModal">
                            {{ __('Agregar') }}
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>

        

        {{-- table --}}
        <div>
            <div class="shadow-sm overflow-hidden my-8">
                <table class="border-collapse table-auto w-full text-sm">
                  <thead>
                    <tr>
                        <th class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-left">#</th>
                        <th class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-left">Name</th>
                        <th class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-left">Email</th>
                        <th class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-left">Role</th>
                        <th class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-left"></th>
                    </tr>
                  </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $item)
                            <tr>
                                <td class="border-b border-gray-100 p-4 text-gray-500">{{ $item->id }}</td>
                                <td class="border-b border-gray-100 p-4 text-gray-900">{{ $item->name }}</td>
                                <td class="border-b border-gray-100 p-4 text-gray-900">{{ $item->email }}</td>
                                <td class="border-b border-gray-100 p-4 text-gray-900 capitalize">{{ $item->role }}</td>
                                {{-- <td class="border-b border-gray-100 p-4 text-gray-500">
                                    @if ($item->estado == 1)
                                        <a wire:click="inactivarShowModal({{ $item->id }})" class="cursor-pointer py-1 px-2 font-semibold text-green-600 bg-green-200 text-center rounded shadow">Activo</a>
                                    @else
                                        <a wire:click="activo({{ $item->id }})" class="cursor-pointer py-1 px-2 font-semibold text-red-600 bg-red-200 text-center rounded shadow">Inactivo</a>
                                    @endif
                                </td> --}}
                               
                                <td class="border-b border-gray-100 p-4 text-gray-500">
                                    {{-- <x-blue-button wire:click="confirmResetPasswordModal({{ $item->id }})" >
                                        {{__('Assign Role')}}
                                    </x-blue-button> --}}
                                    <x-yellow-button wire:click="confirmResetPasswordModal({{ $item->id }})" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </x-yellow-button>
                                    <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
        </div> {{-- end table --}}

    </div>{{-- main div --}}

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('User') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                    wire:model.debounce.500ms="name" />
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                    wire:model.debounce.500ms="email" />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select id="role"  class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="role" wire:model.debounce.500ms="role">
                    <option>Seleccionar</option>
                    <option value="admin">{{ __('Admin') }}</option>
                    <option value="agent">{{ __('Agent') }}</option>
                    <option value="client">{{ __('Client') }}</option>
                </select>
                @error('role')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            @if ($formMode == 'create')
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="number" name="password"
                        wire:model.debounce.500ms="password" />
                    @error('precio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($modelId)
                <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDelete">
        <x-slot name="title">
            {{ __('Delete User') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this user?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Reset Password Modal --}}
    <x-jet-dialog-modal wire:model="modalResetPassword">
        <x-slot name="title">
            {{ __('Reset Password') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to reset the password to -> 12345678 <-.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalResetPassword')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="resetPassword" wire:loading.attr="disabled">
                {{ __('Reset Password') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
