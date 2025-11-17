<div class="max-w-md mx-auto w-25 mt-10 bg-white p-6 rounded shadow" style="margin-top: 150px !important">
    <h2 class="text-l font-semibold mb-4">Login</h2>

    <form wire:submit.prevent="login" class="p-5">
        <input type="email" wire:model="email" placeholder="Email" class="w-full mb-3 border p-2 rounded">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="password" wire:model="password" placeholder="Password" class="w-full mb-3 border p-2 rounded">
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button class="btn btn-primary text-white px-4 py-2 rounded w-full">Login</button>
        <div class="mt-4">
            <a href="{{ route('orcid.redirect') }}"
            class="bg-green-600 text-black px-4 py-2 rounded w-full block text-center">
                <img src="https://orcid.org/sites/default/files/images/orcid_16x16.png"
                    class="inline-block mr-2 text-dark">
                Login with ORCID
            </a>
        </div>

    </form>

    <p class="text-sm text-center mt-3">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-blue-500">Register</a>
    </p>
</div>
