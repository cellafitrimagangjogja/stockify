@extends('example_admin.layouts.default.dashboard')

@section('title', 'Edit Pengguna')

@section('content')

      <div class="container mx-auto px-6 py-6">

      <h1 class="text-2xl font-bold mb-5">
            Edit Pengguna
      </h1>

      <form action="{{ route('admin.users.update', $users->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow p-6">

                  <hr class="my-6">

                  <div class="mb-4">
                  <label>Nama Pengguna</label>

                  <input
                        type="text"
                        name="name"
                        value="{{ old('name', $users->name) }}"
                        class="w-full border rounded p-2">
                  </div>

                  <div class="mb-4">

                  <label>Email</label>

                  <input
                        type="text"
                        name="email"
                        value="{{ old('email', $users->email) }}"
                        class="w-full border rounded p-2">

                  </div>

                  <div class="mb-4">

                  <label>Password Baru</label>

                  <input
                        type="text"
                        name="password"
                        class="w-full border rounded p-2">

                        <p class="mt-1 text-sm text-gray-500">
                              Password harus terdiri dari 8 karakter.
                        </p>

                        @error('password')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                  </div>

                  <div class="mb-4">
                    
                  <label>Kategori</label>

                  <select name="role"
                              class="w-full border rounded p-2">

                       

                            <option value="Admin">Admin</option>
                            <option value="Manajer Gudang">Manajer Gudang</option>
                            <option value="Staff Gudang">Staff Gudang</option>

                        

                  </select>


                  <div class="flex gap-3 mt-8">

                  <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                        Update

                  </button>

                  <a href="{{ route('admin.users.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Kembali

                  </a>

                  </div>

            </div>

      </form>

</div>

      @endsection
    
</script>