{{-- Formulaire partagé pour create et edit --}}
@php
    $isEdit = isset($match) && $match->exists;
@endphp

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">
            {{ $isEdit ? 'Modifier le match' : 'Ajouter un match' }}
        </h1>
        <a href="{{ route('admin.matchs.index') }}" class="text-gray-600 hover:text-gray-900">
            ← Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
<form action="{{ $isEdit ? route('admin.matchs.update', $match->id) : route('admin.matchs.store') }}" 
      method="POST" 
      enctype="multipart/form-data">  {{-- 👈 Ajoutez ceci --}}
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Date du match -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date et heure du match *
                    </label>
                    <input type="datetime-local" 
                           name="date_match" 
                           value="{{ old('date_match', $isEdit ? $match->date_match->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red @error('date_match') border-red-500 @enderror"
                           required>
                    @error('date_match')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Compétition -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Compétition *
                    </label>
                    <select name="competition" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red @error('competition') border-red-500 @enderror"
                            required>
                        <option value="">Sélectionner une compétition</option>
                        <option value="Ligue 1 Sénégal" {{ old('competition', $isEdit ? $match->competition : '') == 'Ligue 1 Sénégal' ? 'selected' : '' }}>
                            Ligue 1 Sénégal
                        </option>
                        <option value="Coupe du Sénégal" {{ old('competition', $isEdit ? $match->competition : '') == 'Coupe du Sénégal' ? 'selected' : '' }}>
                            Coupe du Sénégal
                        </option>
                        <option value="Coupe de la Ligue" {{ old('competition', $isEdit ? $match->competition : '') == 'Coupe de la Ligue' ? 'selected' : '' }}>
                            Coupe de la Ligue
                        </option>
                        <option value="Ligue des Champions CAF" {{ old('competition', $isEdit ? $match->competition : '') == 'Ligue des Champions CAF' ? 'selected' : '' }}>
                            Ligue des Champions CAF
                        </option>
                        <option value="Match Amical" {{ old('competition', $isEdit ? $match->competition : '') == 'Match Amical' ? 'selected' : '' }}>
                            Match Amical
                        </option>
                    </select>
                    @error('competition')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

{{-- Équipe domicile --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Équipe domicile *
    </label>
    <input type="text" 
           name="equipe_domicile" 
           value="{{ old('equipe_domicile', $isEdit ? $match->equipe_domicile : 'ASC Disso') }}"
           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red"
           required>
</div>

{{-- Logo domicile --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Logo domicile
    </label>
    <input type="file" 
           name="logo_domicile" 
           accept="image/*"
           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
    @if($isEdit && $match->logo_domicile)
        <div class="mt-2 flex items-center space-x-2">
            <img src="{{ $match->logo_domicile_url }}" alt="Logo" class="w-10 h-10 object-contain">
            <span class="text-xs text-gray-500">Logo actuel</span>
        </div>
    @endif
    <p class="text-xs text-gray-500 mt-1">Format carré recommandé (PNG, JPG). Max 2Mo.</p>
</div>

{{-- Équipe extérieur --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Équipe extérieur *
    </label>
    <input type="text" 
           name="equipe_exterieur" 
           value="{{ old('equipe_exterieur', $isEdit ? $match->equipe_exterieur : '') }}"
           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red"
           required>
</div>

{{-- Logo extérieur --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Logo extérieur
    </label>
    <input type="file" 
           name="logo_exterieur" 
           accept="image/*"
           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
    @if($isEdit && $match->logo_exterieur)
        <div class="mt-2 flex items-center space-x-2">
            <img src="{{ $match->logo_exterieur_url }}" alt="Logo" class="w-10 h-10 object-contain">
            <span class="text-xs text-gray-500">Logo actuel</span>
        </div>
    @endif
    <p class="text-xs text-gray-500 mt-1">Format carré recommandé (PNG, JPG). Max 2Mo.</p>
</div>

                <!-- Score domicile -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Score domicile
                    </label>
                    <input type="number" 
                           name="score_domicile" 
                           min="0"
                           value="{{ old('score_domicile', $isEdit ? $match->score_domicile : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
                </div>

                <!-- Score extérieur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Score extérieur
                    </label>
                    <input type="number" 
                           name="score_exterieur" 
                           min="0"
                           value="{{ old('score_exterieur', $isEdit ? $match->score_exterieur : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Statut *
                    </label>
                    <select name="statut" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red @error('statut') border-red-500 @enderror"
                            required
                            onchange="toggleMinuteField(this.value)">
                        <option value="a_venir" {{ old('statut', $isEdit ? $match->statut : '') == 'a_venir' ? 'selected' : '' }}>
                            À venir
                        </option>
                        <option value="en_cours" {{ old('statut', $isEdit ? $match->statut : '') == 'en_cours' ? 'selected' : '' }}>
                            En cours
                        </option>
                        <option value="termine" {{ old('statut', $isEdit ? $match->statut : '') == 'termine' ? 'selected' : '' }}>
                            Terminé
                        </option>
                    </select>
                    @error('statut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Minute (si en cours) -->
                <div id="minute-field" style="{{ old('statut', $isEdit ? $match->statut : '') == 'en_cours' ? '' : 'display:none;' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Minute de jeu
                    </label>
                    <input type="number" 
                           name="minute" 
                           min="0" 
                           max="120"
                           value="{{ old('minute', $isEdit ? $match->minute : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
                </div>

                <!-- Stade -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Stade
                    </label>
                    <input type="text" 
                           name="stade" 
                           value="{{ old('stade', $isEdit ? $match->stade : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
                </div>

                <!-- Saison -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Saison *
                    </label>
                    <select name="saison" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red @error('saison') border-red-500 @enderror"
                            required>
                        <option value="2024-2025" {{ old('saison', $isEdit ? $match->saison : '') == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ old('saison', $isEdit ? $match->saison : '2025-2026') == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                        <option value="2026-2027" {{ old('saison', $isEdit ? $match->saison : '') == '2026-2027' ? 'selected' : '' }}>2026-2027</option>
                    </select>
                    @error('saison')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buteurs -->
            <div class="grid md:grid-cols-2 gap-6 mt-6">
<!-- Buteurs domicile -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Buteurs domicile
        <span class="text-xs text-gray-500">(Un par ligne : "Nom Min'")</span>
    </label>
    <textarea name="buteurs_domicile" 
              rows="4"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red"
              placeholder="M. Diop 23'&#10;I. Sarr 67'">{{ old('buteurs_domicile', $isEdit && $match->buteurs_domicile ? implode("\n", (array)$match->buteurs_domicile) : '') }}</textarea>
</div>

<!-- Buteurs extérieur -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Buteurs extérieur
        <span class="text-xs text-gray-500">(Un par ligne : "Nom Min'")</span>
    </label>
    <textarea name="buteurs_exterieur" 
              rows="4"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red"
              placeholder="A. Ndiaye 45'&#10;M. Fall 78'">{{ old('buteurs_exterieur', $isEdit && $match->buteurs_exterieur ? implode("\n", (array)$match->buteurs_exterieur) : '') }}</textarea>
</div>
            </div>

            <!-- Visibilité -->
            <div class="mt-6">
                <label class="flex items-center space-x-3">
                    <input type="checkbox" 
                           name="is_visible" 
                           value="1"
                           {{ old('is_visible', $isEdit ? $match->is_visible : true) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-red focus:ring-primary-red">
                    <span class="text-sm font-medium text-gray-700">Match visible sur le site public</span>
                </label>
            </div>

            <!-- Boutons -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.matchs.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-primary-red text-white rounded-lg hover:bg-red-700 transition">
                    {{ $isEdit ? 'Mettre à jour' : 'Ajouter le match' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleMinuteField(statut) {
    const minuteField = document.getElementById('minute-field');
    if (statut === 'en_cours') {
        minuteField.style.display = '';
    } else {
        minuteField.style.display = 'none';
    }
}
</script>