@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-xl md:text-2xl font-bold">Gestion des Matchs</h1>
        <a href="{{ route('admin.matchs.create') }}" class="btn-primary px-4 py-2 rounded-lg text-sm whitespace-nowrap">
            + Nouveau Match
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Desktop : Tableau -->
    <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Compétition</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visible</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($matchs as $match)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $match->date_formatee }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $match->equipe_domicile }} vs {{ $match->equipe_exterieur }}</td>
                    <td class="px-4 py-3 text-sm">{{ $match->score ?? 'N/A' }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full bg-{{ $match->couleur_statut }}-100 text-{{ $match->couleur_statut }}-800">
                            {{ $match->label_statut }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $match->competition }}</td>
                    <td class="px-4 py-3">
                        <button onclick="toggleVisibility({{ $match->id }})" 
                                class="px-3 py-1 rounded-full text-xs {{ $match->is_visible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $match->is_visible ? 'Oui' : 'Non' }}
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.matchs.edit', $match->id) }}" class="text-blue-600 hover:text-blue-900 text-sm">Modifier</a>
                            <form action="{{ route('admin.matchs.destroy', $match->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Confirmer ?')">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile : Cartes -->
    <div class="md:hidden space-y-4">
        @foreach($matchs as $match)
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="font-bold text-sm">{{ $match->equipe_domicile }} vs {{ $match->equipe_exterieur }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $match->date_formatee }}</div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full bg-{{ $match->couleur_statut }}-100 text-{{ $match->couleur_statut }}-800">
                    {{ $match->label_statut }}
                </span>
            </div>
            <div class="flex justify-between items-center text-sm mb-3">
                <span class="text-gray-600">{{ $match->competition }}</span>
                <span class="font-bold">{{ $match->score ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between items-center">
                <button onclick="toggleVisibility({{ $match->id }})" 
                        class="px-3 py-1 rounded-full text-xs {{ $match->is_visible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $match->is_visible ? 'Visible' : 'Caché' }}
                </button>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.matchs.edit', $match->id) }}" class="text-blue-600 text-sm">Modifier</a>
                    <form action="{{ route('admin.matchs.destroy', $match->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-sm" onclick="return confirm('Confirmer ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $matchs->links() }}
    </div>
</div>

<script>
function toggleVisibility(id) {
    fetch(`/admin/matchs/${id}/toggle-visibility`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    });
}
</script>
@endsection