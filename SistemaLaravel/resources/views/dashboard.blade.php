<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule') }}
        </h2>
    </x-slot>

    <x-slot name="content">
    <div class="container">
        <div class="d-flex gap-2 justify-content-between
            bg-light border border-2 p-3 my-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#criarAnotacao">
                Add Event
            </button>
            <!-- Modal -->
            <div class="modal fade" id="criarAnotacao" tabindex="-1" aria-labelledby="criarAnotacaoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="criarAnotacaoLabel">Add Event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('create.note') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <label>Event:</label>
                                <input class="form-control" type="text" name="title">
                                <label>Date:</label>
                                <input class="form-control" name="content" type="date">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-primary">
                                    Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="d-flex flex-wrap justify-content-start g-2">
            @forelse($notes as $note)
                <div class="col-12 col-md-6 col-lg4 p-2">
                    <div class="card border border-2 shadow p-3 w-100 ">
                        <div class="card-header">
                            {{ $note->title }}
                        </div>
                        <div class="card-body">
                            {{ $note->content }}
                        </div>
                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            {{-- Edition --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editar_anotacao"
                            data-bs-note="{{ json_encode($note) }}">
                                Edit
                            </button>
                            {{-- Exclusão --}}
                            <form action="{{ route('delete.note', ['id' => $note->id]) }}" method="post">
                                @csrf
                                {{-- <input type="hidden" name="id" value="{{ $note->id }}"> --}}
                                <button class="btn btn-outline-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    No events registered!
                </div>
            @endforelse
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editar_anotacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Event</h1>
                    <button type="button" class="btn-outline-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update.note') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <label>Event:</label>
                        <input class="form-control" type="text" name="title" id="title">
                        <label>Date:</label>
                        <input class="form-control" name="content" type="date">
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
    </x-slot>

</x-app-layout>
