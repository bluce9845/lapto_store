<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card text-center" style="width: 18rem; margin: 0 0 0 40%">
                        <div class="card-body">
                            <h5 class="card-title text-green-600">Success!</h5>
                            <p class="card-text">Berhasil melakukan pembayaran!</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary" id="pay-button">Back to
                                dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
