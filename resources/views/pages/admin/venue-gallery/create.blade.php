@extends('layouts.admin.app')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Tambah Galeri Venue</h2>
</div>
<div class="grid grid-cols-12 lg:grid-cols-none gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ route("admin.galeri_venue.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Nama Venue</label>
                    <select name="venue_id" class="select2 w-full mt-2">
                        @foreach ($venues as $venue)
                            <option value="{{ $venue->id }}">{{ $venue->slug }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <label>Gambar Venue</label>
                    <img class="image-preview" alt="" width="300px">
                    <input type="file" name="gallery" class="input w-full border mt-2 image-input" onchange="previewImage()">
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
@push('script')
    @if(session("error"))
    <script>
        // error alert
        Swal.fire(
            "Gagal",
            `{{ session("error") }}`,
            "error"
        );
    </script>
    @elseif($errors->any())
    <script>
        // erro alert
        Swal.fire(
            "Gagal",
            `@foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach`,
            "error"
        );
    </script>
    @endif
    <script>
        function previewImage()
        {
            const image_input = document.querySelector(".image-input");
            const image_preview = document.querySelector(".image-preview");
            
            image_preview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image_input.files[0]);

            oFReader.onload = function(oFREvent) {
                image_preview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
@endsection