<script setup>
import UserSvg from './UserSVG.vue';
</script>
<template>
    <div>
        <div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border-indigo-500 rounded-md p-3">
                    <user-svg
                        class="h-6 w-6 text-white"
                    ></user-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">Total Users</div>
                    <div class="text-lg font-semibold text-gray-800">{{ 10 }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
