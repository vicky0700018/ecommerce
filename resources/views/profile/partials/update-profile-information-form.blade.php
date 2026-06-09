<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Image Upload -->
        <div>
            <div class="mb-6">
                <label class="text-lg font-semibold text-gray-900 mb-4 block">📸 Profile Picture</label>
                
                <!-- Current Image Display -->
                <div class="mb-6">
                    @if($user->profile_image)
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-purple-300 shadow-lg">
                                <span class="absolute bottom-0 right-0 bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✓</span>
                            </div>
                            <button type="button" onclick="document.getElementById('profile_image').click()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-semibold transition">
                                🖼️ Update Image
                            </button>
                        </div>
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-300 to-blue-300 flex items-center justify-center text-2xl border-4 border-purple-300">
                            👤
                        </div>
                    @endif
                </div>

                <p class="text-sm text-gray-600 mb-3">Upload a new profile picture (JPG, PNG - Max 2MB)</p>
                <input type="file" id="profile_image" name="profile_image" accept="image/jpeg,image/png,image/jpg" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-3 file:px-6
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-purple-600 file:text-white
                    hover:file:bg-purple-700
                    file:cursor-pointer
                    cursor-pointer" />
                <p class="text-xs text-gray-500 mt-2">Recommended: Square image, at least 200x200px</p>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
