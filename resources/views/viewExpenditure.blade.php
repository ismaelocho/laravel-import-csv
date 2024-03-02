<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses Import') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <h1 class="font-bold text-xl mb-2">Expenses Import from Excel or CSV File</h1>
                <div class="w-full max-w-xs">
                <form method="post" action="{{ route('expenditure.import') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
        
                    @if ($message = Session::get('success'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                <p class="font-bold">In Process!</p>
                                <p class="text-sm">{{ $message }}.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mb-6 p-6">
                        <strong>XLS or CSV File:</strong>
                        <input type="file" name="file" class="form-control" accept="csv,.xls,.xlsx" required />
                    </div>
                    <div class="flex items-center justify-between  px-6 py-2">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Import</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
