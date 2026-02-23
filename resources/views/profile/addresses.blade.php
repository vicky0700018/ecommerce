@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-black text-purple-900 mb-8">📍 My Addresses</h1>

        @if ($message = Session::get('success'))
            <div class="bg-green-400 text-purple-900 px-6 py-4 rounded-xl mb-6 shadow-lg font-bold animate-pulse">
                ✨ {{ $message }}
            </div>
        @endif

        <!-- Add Address Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 border-2 border-purple-300">
            <h2 class="text-2xl font-black text-purple-900 mb-6">➕ Add New Address</h2>

            <form action="{{ route('address.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">Street Address</label>
                        <input type="text" name="street" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" placeholder="123 Main St" required>
                    </div>
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">City</label>
                        <input type="text" name="city" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" placeholder="Mumbai" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">State</label>
                        <input type="text" name="state" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" placeholder="Maharashtra" required>
                    </div>
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">Postal Code</label>
                        <input type="text" name="postal_code" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" placeholder="400001" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">Country</label>
                        <input type="text" name="country" value="India" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" required>
                    </div>
                    <div>
                        <label class="block text-purple-900 font-bold mb-2">Phone</label>
                        <input type="text" name="phone" class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:outline-none focus:border-purple-600" placeholder="9876543210" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_default" class="w-5 h-5 text-purple-600 rounded">
                        <span class="ml-3 text-purple-900 font-bold">Set as default address</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 font-bold shadow-lg transition transform hover:scale-105">
                    ✓ Add Address
                </button>
            </form>
        </div>

        <!-- Saved Addresses -->
        <h2 class="text-2xl font-black text-purple-900 mb-4">📮 Saved Addresses</h2>

        @if ($addresses->isEmpty())
            <div class="bg-purple-100 rounded-2xl shadow-xl p-8 text-center border-2 border-purple-300">
                <p class="text-purple-900 font-bold text-lg">No addresses saved yet. Add one above! 👇</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($addresses as $address)
                    <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-purple-600">
                        @if ($address->is_default)
                            <span class="inline-block bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-black mb-3">⭐ DEFAULT</span>
                        @endif
                        
                        <p class="text-purple-900 font-bold mb-3">📍 {{ $address->street }}, {{ $address->city }}</p>
                        <p class="text-gray-700 text-sm mb-2">{{ $address->state }} {{ $address->postal_code }}</p>
                        <p class="text-gray-700 text-sm mb-4">{{ $address->country }} • 📱 {{ $address->phone }}</p>

                        <div class="flex gap-2">
                            <form action="{{ route('address.destroy', $address) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-bold text-sm transition" onclick="return confirm('Delete this address?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
