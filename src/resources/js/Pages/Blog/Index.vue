<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    blogs: Object,
});

const searchForm = useForm({
    title: '',
    user: '', 
});

const search = () => {
    searchForm.get(route('blog.index'));
}

const clickedBlog = (blogId: number) => {
    router.get(route('blog.show', blogId));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="space-y-12">
            <!-- 検索 -->
            <form @submit.prevent="search" class="flex justify-center gap-x-2">
                <div class="w-full">
                    <label class="block w-full">
                        タイトル
                        <input v-model="searchForm.title" class="w-full rounded-md py-1 px-2 text-gray-900 shadow-sm border border-gray-300 placeholder:text-gray-400 focus:ring-1 focus:outline-none focus:border-indigo-500 focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </label>
                    <label class="block w-full">
                        投稿者
                        <input v-model="searchForm.user" class="rounded-md py-1 px-2 text-gray-900 shadow-sm border border-gray-300 placeholder:text-gray-400 focus:ring-1 focus:outline-none focus:border-indigo-500 focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </label>
                </div>
                <div class="">
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">検索</button>
                </div>
            </form>

            <!-- 表示 -->
            <div class="grid grid-cols-3 gap-6">
                <div v-for="blog in props.blogs" :key="blog.id" @click="clickedBlog(blog.id)" class="col-span-1 bg-white shadow-lg" >
                    <div class="px-4 py-2 font-semibold border-b border-b-gray-300">
                        {{ blog.user.name }}
                    </div>
                    <div class="px-4 py-2 font-bold text-xl">
                        {{ blog.title }}
                    </div>
                    <div class="px-4 py-2">
                        ここには写真を入れたい
                    </div>
                </div>
            </div>
            <!-- ページネーション -->
        </div>
    </AuthenticatedLayout>
</template>