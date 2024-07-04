<div id="deleteModal" tabindex="-1" class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow p-6 w-80">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
        <p id="deleteMessageContent" class="mb-4">Apakah Anda yakin ingin menghapus pengguna ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2" data-modal-hide="deleteModal">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>
