<x-app-layout>


    <div class="max-w-3xl mx-auto py-10 px-4">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-5">
                <h1 class="text-3xl font-bold text-white">
                    📝 Todoリスト
                </h1>
                <p class="text-blue-100 mt-1">
                    今日やることを管理しましょう
                </p>
            </div>

            <div class="p-6">
                {{-- フラッシュメッセージ --}}
                @if (session('message'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                        {{ session('message') }}
                    </div>
                @endif


                <form action="{{ route('practices.index') }}" method="GET" class="mb-6">
                    <div class="flex gap-3">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="タスクを検索..."
                            class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        <button type="submit"
                            class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition duration-200 shadow-md">
                            検索
                        </button>

                        @if ($keyword)
                            <a href="{{ route('practices.index') }}"
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition duration-200">
                                解除
                            </a>
                        @endif
                    </div>
                </form>

                <form action="{{ route('practices.store') }}" method="POST" class="mb-8">
                    @csrf

                    <div class="flex gap-3">
                        <input type="text" name="title" placeholder="新しいタスクを入力..." required
                            class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition duration-200 shadow-md">
                            追加
                        </button>
                    </div>
                </form>

                <div class="space-y-3">
                    @forelse($practices as $practice)
                        <p class="text-sm text-gray-500">
                            {{ $practice->created_at->format('Y/m/d H:i') }}
                        </p>
                        <div
                            class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 hover:shadow-md transition">

                            <div class="flex items-center gap-3">

                                {{-- 完了・未完了 --}}
                                <form action="{{ route('practices.toggle', $practice) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="text-2xl">
                                        @if ($practice->is_completed)
                                            ☑️
                                        @else
                                            ⬜
                                        @endif
                                    </button>
                                </form>

                                <span
                                    class="{{ $practice->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                    {{ $practice->title }}
                                </span>

                            </div>

                            <div class="flex gap-2">

                                <a href="{{ route('practices.edit', $practice) }}"
                                    class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition">
                                    編集
                                </a>

                                <form action="{{ route('practices.destroy', $practice) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition">
                                        削除
                                    </button>
                                </form>

                            </div>

                        </div>


                    @empty
                        <div class="text-center py-10">
                            <div class="text-5xl mb-3">
                                📭
                            </div>

                            <p class="text-gray-500">
                                @if ($keyword)
                                    一致するタスクはありません
                                @else
                                    タスクはまだありません
                                @endif
                            </p>

                            <p class="text-sm text-gray-400 mt-1">
                                @if ($keyword)
                                    別のキーワードで検索してみましょう
                                @else
                                    最初のタスクを追加してみましょう
                                @endif
                            </p>
                        </div>
                    @endforelse
                    {{ $practices->links() }}

                </div>

            </div>

        </div>

    </div>


</x-app-layout>
