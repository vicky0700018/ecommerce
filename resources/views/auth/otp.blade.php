<x-guest-layout>
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <div>
            <label>Enter OTP</label>
            <input type="text" name="otp" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">
                Verify OTP
            </button>
        </div>

        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        @error('otp')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </form>
</x-guest-layout>
