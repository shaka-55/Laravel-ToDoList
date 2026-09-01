<x-app-layout>

    <div class="max-w-2xl mx-auto py-10 px-4">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5">
                <h1 class="text-3xl font-bold text-white">
                    ✏️ Todo編集
                </h1>
                <p class="text-yellow-100 mt-1">
                    タスクを編集しましょう
                </p>
            </div>

            <div class="p-6">

                <form action="{{ route('practices.update', $practice) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            タスク名
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ $practice->title }}"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition duration-200">
                            更新
                        </button>

                        <a
                            href="{{ route('practices.index') }}"
                            class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-xl transition duration-200">
                            戻る
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>