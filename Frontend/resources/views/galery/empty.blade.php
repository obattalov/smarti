<x-app-layout>
    <x-slot name="header">
            {{ __('Pokemon List') }}
    </x-slot>
    <div class="row">
        <div class="col-12 text-center">
        <div class="alert alert-danger" role="alert">
            Database is empty. Try to <a href="{{ route('galery.completedb') }}">autocomplete</a> it.
        </div>
        
        </div>
    </div>

    
    </div>
</x-app-layout>
