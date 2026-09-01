<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 ">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>

        @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-6 p-6 bg-white rounded-2xl shadow-md border border-gray-200">
            <div class="mt-4 p-4">
                <p class="text-lg font-semibold">
                    {{ $post->title }}
                </p>
                <div class="flex justify-end items-center gap-3 mt-4">
                    <a href="{{ route('blog.edit', $post) }}"
                        class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        編集
                    </a>

                    <form action="{{ route('blog.destroy', $post) }}" method="POST"
                        onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                            削除
                        </button>
                    </form>
                </div>
                <hr class="w-full">
                <p class="mt-4 whitespace-pre-line">
                    {{ $post->body }}
                </p>
                <div class="flex justify-end w-full text-sm font-semibold">
                    <p>{{ $post->created_at }}</p>
                </div>
            </div>

        </div>

</x-app-layout>
