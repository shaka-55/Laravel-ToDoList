<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 ">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
        <form action="{{ route('blog.index') }}" method="GET" class="mb-6">
            <div class="flex gap-3">
                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="タスクを検索..."
                    class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                <button type="submit"
                    class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition duration-200 shadow-md">
                    検索
                </button>

                @if ($keyword)
                    <a href="{{ route('blog.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition duration-200">
                        解除
                    </a>
                @endif
            </div>
        </form>

        @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <div class="mx-auto px-6">
            @foreach ($posts as $post)
                <div class="mt-6 p-6 bg-white rounded-2xl shadow-md border-gray-200">
                    <p class="p-4 text-lg font-semibold">
                        <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                            {{ $post->title }}
                        </a>

                    </p>
                    <hr class="w-full">
                    <p class="mt-4 p-4">{{ $post->body }}</p>
                    <div class="flex justify-end p-4 text-sm font-semibold">
                        <p>
                            {{ $post->created_at }}/{{ $post->user->name }}
                        </p>
                    </div>
                </div>
            @endforeach
            <div class="mb-4">{{ $posts->links() }}</div>
        </div>
    </div>
</x-app-layout>
