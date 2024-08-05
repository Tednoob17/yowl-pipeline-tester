<script setup>
import UserSvg from './UserSVG.vue';
import MobileSvg from './MobileSVG.vue';
import CommentSvg from './CommentSVG.vue';
import AverageSvg from './AverageSVG.vue';
import TimeSvg from './TimeSVG.vue';
import { ref, defineProps } from 'vue';

const props = defineProps({
    stats: Object,
});
</script>
<template>
    <div>
        <div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border border-indigo-500 rounded-md p-3">
                    <user-svg
                        class="h-6 w-6 text-white"
                    ></user-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">Total Users</div>
                    <div class="text-lg font-semibold text-gray-800">{{ stats.user_count }}</div>
                </div>
            </div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border border-indigo-500 rounded-md p-3">
                    <mobile-svg
                        class="h-6 w-6 text-white"
                    ></mobile-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">Most common browser used by user</div>
                    <div class="text-lg font-semibold text-gray-800">{{ stats.most_common_browser.name }}</div>
                </div>
            </div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border border-indigo-500 rounded-md p-3">
                    <comment-svg
                        class="h-6 w-6 text-white"
                    ></comment-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">
                        Total Comments
                    </div>
                    <div class="text-lg font-semibold text-gray-800">{{ stats.comment_counts}}</div>
                </div>
            </div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border border-indigo-500 rounded-md p-3">
                    <average-svg
                        class="h-6 w-6 text-white"
                    ></average-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">
                        Average Comment per user
                    </div>
                    <div class="text-lg font-semibold text-gray-800">{{ stats.average_comments_per_user }}</div>
                </div>
            </div>
            <div class="flex items-center m-2">
                <div class="flex-shrink-0 border border-indigo-500 rounded-md p-3">
                    <time-svg
                        class="h-6 w-6 text-white"
                    ></time-svg>
                </div>
                <div class="ml-4">
                    <div class="text-lg font-semibold text-gray-600">
                        Average time before first comment
                    </div>
                    <div class="text-lg font-semibold text-gray-800">{{ stats.average_time_before_comment ?? "Coming soon" }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
