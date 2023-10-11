<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Roulette from '@/Components/Roulette.vue';
import type { Ref } from "vue";
import { ref } from "vue";
import { Wheel } from "vue3-fortune-wheel";
import type { Datas, imgParams } from "vue3-fortune-wheel";

interface Result {
    id: 1,
    value: string,
    bgColor: string,
    color: string,
}

const firstResult: Ref<Result | null> = ref(null)
const secondResult: Ref<Result | null> = ref(null) 

const isFirstStep: Ref<boolean> = ref(true)
const isSecondStep: Ref<boolean> = ref(false)

// ジャンル決定用のルーレット
const firstData: Ref<any> = ref([
    {
        id: 1,
        value: "和食",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 2,
        value: "韓国",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
        id: 3,
        value: "中華",
        bgColor: "#c92729",
        color: "#ffffff",
    },
    {
        id: 4,
        value: "アメリカン",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 5,
        value: "イタリアン",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
        id: 6,
        value: "フレンチ",
        bgColor: "#c92729",
        color: "#ffffff",
    },
    {
        id: 7,
        value: "スパニッシュ",
        bgColor: "#c92729",
        color: "#ffffff",
    },
    {
        id: 8,
        value: "メキシカン",
        bgColor: "#c92729",
        color: "#ffffff",
    },
]);

const firstLogo: imgParams = {
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/2367px-Vue.js_Logo_2.svg.png",
    width: 100,
    height: 120,
};

const selectedFirstData = (value: Result) => {
    firstResult.value = value
    isFirstStep.value = false
    isSecondStep.value = true
}

// 料理決定用のルーレット
const secondData: Ref<any> = ref([
    {
        id: 1,
        value: "和食",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 2,
        value: "韓国",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
        id: 3,
        value: "中華",
        bgColor: "#c92729",
        color: "#ffffff",
    },
    {
        id: 4,
        value: "アメリカン",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 5,
        value: "イタリアン",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
        id: 6,
        value: "フレンチ",
        bgColor: "#c92729",
        color: "#ffffff",
    },
]);

const selectedSecondData = (value: Result) => {
    secondResult.value = value
}

</script>

<template>
    <GuestLayout>
        <div>
            <!-- ルーレット関連 -->
            <div class="p-4 border border-gray-500 shadow-lg">
                <h2 class="font-bold text-xl text-center">お食事ルーレット</h2>
                <!-- ジャンルルーレット -->
                <div class="sm:grid sm:grid-cols-2">
                    <div class="my-6 sm:col-span-1">
                        <h3 class="pl-2 font-semibold text-lg border-l-4 border-cyan-500">ジャンル</h3>
                        <div class="flex justify-center">
                            <Roulette :data="firstData" :logo="firstLogo" @result="selectedFirstData"/>
                        </div>
                        <p v-if="firstResult">{{ firstResult.value }}</p>
                    </div>
                    <!-- 料理ルーレット -->
                    <div class="my-6 sm:col-span-1">
                        <h3 class="pl-2 font-semibold text-lg border-l-4 border-indigo-500">料理</h3>
                        <div class="flex justify-center">
                            <Roulette :data="secondData" :logo="firstLogo" @result="selectedSecondData"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ログイン後に解禁される機能についての告知 -->
            <div>

            </div>
        </div>  
    </GuestLayout>
</template>