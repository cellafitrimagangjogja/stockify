<section>
    <div class="bg-white rounded-lg shadow p-6">

        <div class="mb-6">
            <h2 class="text-xl font-extrabold text-green-900">
                Informasi Profil
            </h2>

            <p class="mt-1 text-sm text-grey-500">
                Perbarui informasi akun Anda.
            </p>
        </div>

        <form method="POST"
              action="{{ route('profilestaff.update') }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-col items-start mb-6">

                <div class="inline-flex border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 p-2">
                    <img
                        id="preview-image"
                        src="{{ $user->image 
                            ? asset('storage/profile/' . $user->image) 
                            : 'https://placehold.co/250x250?text=Belum+ada+foto' }}"
                        class="w-44 h-44 object-cover rounded-lg"
                        alt="Foto Profile"
                    >
                </div>

                <label class="mt-4 text-sm font-medium ">
                    Foto Profile
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/*"
                    class="mt-2 block w-full max-w-xs">

            </div>

            {{-- Nama Pengguna --}}
            <div class="mb-4">
                <label for="name"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Pengguna
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white focus:ring-blue-500 focus:border-blue-500"
                    required
                >

                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white focus:ring-blue-500 focus:border-blue-500"
                    required
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="mb-4">
                <label for="password"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Kosongkan jika tidak ingin mengubah password"
                >

                @error('password')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label for="password_confirmation"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white"
                    placeholder="Masukkan ulang password baru"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                    Update
                </button>

            </div>

        </form>

    </div>
</section>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-image');

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>