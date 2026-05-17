@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Récupérer mon compte</h2>
        
        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full border rounded-lg px-4 py-2 @error('email') border-red-500 @enderror" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary w-full py-3 rounded-lg font-bold">
                Envoyer le lien de réinitialisation
            </button>
        </form>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-primary-red hover:underline text-sm">
                Retour à la connexion
            </a>
        </div>
    </div>
</div>
@endsection