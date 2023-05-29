<script setup>
defineProps({
    question: {
        type: String,
        required: true
    },
    question_id: {
        type: String,
        required: true
    },
    question_number: {
        type: Number,
        required: true
    },
    choices: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

<!--            <h1 class="mt-2 text-xl border-b font-bold text-gray-900 dark:text-white">-->
<!--                Question {{ question_number }} of 10-->
<!--            </h1>-->

            <h1 class="mt-2 border-b border-gray-200 dark:border-gray-700 text-2xl font-bold text-gray-900 dark:text-white">
                Who said it?
            </h1>

            <p class="mt-6 text-2xl font-sans text-gray-500 dark:text-gray-400 leading-relaxed">
                {{ question }}
            </p>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div v-for="choice in choices">
                <a :href="route('answer',{'answer': choice.id, 'question': question_id})">
                    <div class="flex justify-center items-center bg-gray-300 hover:bg-sky-700 active:bg-violet-700 dark:bg-gray-500">
                         <h2 class="text-xl font-ringbearer text-center font-semibold p-2 text-gray-900 dark:text-white ">
                            {{ choice.name }}
                         </h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>
