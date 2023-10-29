<script setup lang="ts">
import { nextTick, ref } from 'vue'
import type { Ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    user: Object,
    search: Object,
    existResponse: Boolean,
});


const form = useForm({
    selectedType: props.search.selectedType,
    selectedRadius: props.search.selectedRadius,
    latitude: 0,
    longitude: 0,
});

const types = [
    {id: 1, typeName: 'bar', displayName: 'バー・居酒屋'},
    {id: 2, typeName: 'cafe', displayName: 'カフェ'},
    {id: 3, typeName: 'restaurant', displayName: 'レストラン'},
    {id: 4, typeName: 'convenience_store', displayName: 'コンビニ'},
    {id: 5, typeName: 'supermarket', displayName: 'スーパー'}
]

const radiuss = [
    {id: 1, meters: 400, minutes: 5},
    {id: 2, meters: 800, minutes: 10},
    {id: 3, meters: 1600, minutes: 20},
    {id: 4, meters: 2400, minutes: 30},
    {id: 5, meters: 4800, minutes: 60}
]

const location = ref({
    latitude: 0,
    longitude: 0,
})

const locationError = ref('')

// デバイスの現在地を取得
const getLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            form.latitude = position.coords.latitude
            form.longitude = position.coords.longitude
        },
        (error) => {
            locationError.value = "位置情報が取得できませんでした。"
        });
    } else {
        locationError.value = "位置情報へのアクセスを有効にしてください"
    }
}

getLocation();

const submit = () => {
    const isValidRequest = form.selectedType !== '' && form.selectedRadius !== 0 && form.latitude !== 0 && form.longitude !== 0;
    if(isValidRequest){
        form.get(route('user.map'));
    }
}

// opennow, rankby, type
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-x-4">

                    <label class="col-span-1">
                        ジャンル
                        <select v-model="form.selectedType" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                            <option v-for="type in types" :key="type.id" :value="type.typeName">{{ type.displayName }}</option>
                        </select>
                    </label>

                    <label class="col-span-1">
                        所要移動時間(徒歩)　<span class="test-xs text-gray-500">※ 分速80mとして計算します</span>
                        <select v-model="form.selectedRadius" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                            <option v-for="radius in radiuss" :key="radius.id" :value="radius.meters">{{ radius.minutes }}分</option>
                        </select>
                    </label>

                </div>
                <div v-if="form.latitude && form.longitude" class="mt-6 flex justify-center">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md shadow-md">検索</button>
                </div>
                <p v-else-if="locationError" class="mt-6 text-center">{{ locationError }}</p>
                <p v-else class="mt-6 text-center">......現在地を取得しています</p>
            </form>

            <div v-if="props.existResponse">
                ここはGoogleMapsAPI
            </div>
        </div>
    </AuthenticatedLayout>
</template>