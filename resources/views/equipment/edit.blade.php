<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Equipment</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('equipment.update', $equipment) }}">
                @csrf
                @method('PUT')
                @include('equipment._form', ['submitLabel' => 'Update'])
            </form>
        </div>
    </div>
</x-app-layout>