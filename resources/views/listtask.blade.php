@extends("layouts.main")
@section('content')
    @isset($projets)
        @if(count($projets) > 0)
            @if(session('message'))
                <div id="myAlert" class="alert alert-success text-center" role="alert" style="display: none;">
                    {{ session('message') }}
                </div>
			@endif	
            <table class="table table-striped">
                <thead>
                    <!-- <tr>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Actions</th>
                    </tr> -->
                </thead>
                <tbody>
                    @foreach($projets as $projet)
                        <tr>
                            <td>{{ $projet->libelle }}</td>
                            <td>{{ $projet->description }}</td>
                            <td>{{ $projet->datedebut }}</td>
                            <td>
                                <div class="d-flex">
                                    <form method="POST" action="{{ route('delete_task', ['id' => $projet->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg bg-danger mr-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary bg bg-secondary mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Modifier
                                    </button> 
                                    <form method="POST" action="{{ route('begin_task', ['id' => $projet->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary bg bg-primary">Commenencer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Modification -->
                        <!-- Pop-up modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modification... • TaskEasy</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('update_task', ['id' => $projet->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Libelle</label>
                                                <input type="text" class="form-control" id="libelle" name="libelle" 
                                                placeholder="Renommer votre projet ici" autocomplete="off" 
                                                value="{{ $projet->libelle }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" rows="3" name="description" autocomplete="off"  text-center required>
                                                    {{ $projet->description }}
                                                </textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Date de debut</label>
                                                <input type="date" class="form-control" id="datedebut" name="datedebut" placeholder="YYYY-MM-DD" 
                                                value="{{ $projet->datedebut }}" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="bg bg-secondary btn btn-secondary">Appliquer les changements</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun projet disponible!
            </div>
        @endif
    @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun projet disponible!
            </div>
    @endisset

    <script>
        // Récupérer la div d'alerte
        const alertDiv = document.getElementById('myAlert');

        // Afficher la div d'alerte
        alertDiv.style.display = 'block';

        // Définir un délai de 5 secondes pour masquer la div d'alerte
        setTimeout(function() {
        alertDiv.style.display = 'none';
        }, 5000);
    </script>

@endsection