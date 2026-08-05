@extends('example_admin.layouts.default.dashboard')

@section('title', 'Edit Supplier')

@section('content')

      <div class="container mx-auto px-6 py-6">

      <h1 class="text-2xl font-bold mb-5">
            Edit Supplier
      </h1>

      <form action="{{ route('admin.suppliers.update', $supplier->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow p-6">

                  <hr class="my-6">

                  <div class="mb-4">
                  <label>Nama Supplier</label>

                  <input
                        type="text"
                        name="name"
                        value="{{ old('name', $supplier->name) }}"
                        class="w-full border rounded p-2">
                  </div>

                  <div class="mb-4">

                  <label>Alamat</label>

                  <input
                        type="text"
                        name="address"
                        value="{{ old('address', $supplier->address) }}"
                        class="w-full border rounded p-2">

                  </div>

                  <div class="mb-4">

                  <label>No Hanphone</label>

                  <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        class="w-full border rounded p-2">
                  @error('phone')
                  <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                  </p>
                  @enderror

                  </div>

                  <div class="mb-4">
                    
                  <label>Email</label>

                  <input
                        type="text"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
                        class="w-full border rounded p-2">

                  </div>

                  <div class="flex gap-3 mt-8">

                  <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                        Update

                  </button>

                  <a href="{{ route('admin.categories.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Kembali

                  </a>

                  </div>

            </div>

      </form>

</div>

      @endsection
    
</script>