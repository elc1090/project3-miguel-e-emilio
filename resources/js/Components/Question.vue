<script setup>
defineProps({
    question: {
        type: String,
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

            Pergunta 2 de 10
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Quem disse?
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                {{ question }}
            </p>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div v-for="choice in choices">
                <div class="flex items-center">
                    <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://laravel.com/docs">{{ choice.name }}</a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</template>
