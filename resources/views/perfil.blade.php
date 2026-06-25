<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Mi Perfil</h2>
    </x-slot>

    <div class="py-12">
        <p>Bienvenido, {{ $user->name }}</p>
        <p>Correo: {{ $user->email }}</p>
        <p>Teléfono: {{ $user->telefono }}</p>
    </div>
</x-app-layout>